# Форматтеры

Классы, определяющие формат данных, возвращаемых библиотекой.

* [Общая информация](/docs/formatters.md#общая-информация)
* [Простые типы](/docs/formatters.md#простые-типы)
* [Active Record](/docs/formatters.md#active-record)
  * [Конфигурирование классов](/docs/formatters.md#конфигурирование-классов)
  * [Совместимость подходов](/docs/formatters.md#совместимость-подходов)

## Общая информация

Форматирование применяется к ответам API, возвращаемым [Конструктором запросов](/docs/query_builder.md)) и данным, возвращаемые вспомогательными методами (Meta, Debug и т. д.). На объекты [Active Record](/docs/active_record.md) не установленный форматтер не влияет, их можно привести к нужному типу методами `toArray()`, `toStdClass()` и `toString()`.

Нужный форматтер устанавливается при [инициализации клиента](/docs/setup.md). Все форматтеры реализуют интерфейс `JsonFormatterInterface` с методами `encode` (преобразовать json-строку в нужный формат) и `decode` (обратное преобразование). При необходимости, можно использовать их напрямую. Каждый встроенный форматтер умеют декодировать данные в любом из встроенных форматов. 

```php
$product = Product::make($ms, ['name' => 'orange']);
$currentFormatter = $ms->getFormatter();
$productString = $currentFormatter->decode($product);
$productArray = (new ArrayFormat())->encode($productString);
```

## Простые типы

* `StdClassFormat` - Форматтер по умолчанию. Преобразует данные в объект `stdClass`.
* `ArrayFormat` - Преобразует данные в ассоциативный массив.
* `StringFormat` - Преобразует данные в строку.

## Active Record

`ApiObjectFormatter` - форматтер, преобразующтй данные в формат `ApiObject` ([Документация](/docs/active_record.md)). Данные, не являющиеся объектами Моего Склада, преобразуются в `stdClass`.

Ответы от API преобразуются в объекты на всех уровнях вложенности, что позволяет работать с методами вложенных объектов.

```php
Customerorder::collection($ms)
    ->limit(100)
    ->expand('positions.assortment')
    ->eachGenerator(function (Customerorder $customerorder) {
        echo $customerorder->id . PHP_EOL;

        $customerorder->positions
            ->each(function ($position) {
                echo $position->assortment->name . PHP_EOL;
            });
    });
```

### Конфигурирование классов

`ApiObjectMapping` - конфиг сопоставления объектов Моего Склада с PHP классами. С его помощью можно регистрировать отсутствующие в библиотеке сущности и коллекции, или переопределять текущие.

#### Регистрация

Для регистрации классов используются методы `setObject()` и `setCollection()`. В качестве входных аргументов оба принимают строку с именем класса (или массив строк для массового назначения). Классы сущностей должны наследоваться от `AbstractConcreteObject`, коллекции - от `AbstractConcreteCollection`. И те, и те должны содержать константы `PATH` - массив с сегментами пути url сущности и `TYPE` - значение поля type из meta сущности. Для автокомплита IDE требуется наполнить PHPDoc класса, за примерами можно обратиться к реализованным в библиотеке классам.

```php
/**
 * @property string $id
 */
class Contract extends AbstractConcreteObject
{
    public const PATH = ['entity', 'contract'];
    public const TYPE = 'contract';
}
class ContractCollection extends AbstractConcreteCollection
{
    public const PATH = ['entity', 'contract'];
    public const TYPE = 'contract';
}

$mapping = new ApiObjectMapping();
$mapping
    ->setObject(Contract::class)
    ->setCollection(ContractCollection::class);

$ms = new MoySklad(['token'], new ApiObjectFormatter($mapping));

Contract::collection($ms)
    ->eachGenerator(function (Contract $contract) {
        echo $contract->id . PHP_EOL;
    });
```

#### Переопределение

Помимо регистрации новых сущностей и коллекций, может быть удобно расширять имеющиеся - допустим, чтобы дополнить их нужными методами. Достичь этого можно аналогично, перерегистрировав имеющийся класс.  

```php
class ExtendedProduct extends Product
{
    public function printCodeWithName(): void
    {
        echo $this->code . ' | ' . $this->name . PHP_EOL;
    }
}

$mapping = (new ApiObjectMapping())
    ->setObject(ExtendedProduct::class);

$ms = new MoySklad(['token'], new ApiObjectFormatter($mapping));

Product::collection($ms)
    ->eachGenerator(function (ExtendedProduct $product) {
        $product->printCodeWithName();
    });
```

### Совместимость подходов

Конструктор запросов и Active Record подходы полностью совместимы между собой. Можно как получать Active Record объекты через конструктор запросов, установив соотвутствующий форматтер, так и передавать их в качестве параметров, вне зависимости от установленного форматтера. Аналогично, методы Active Record объектов, требующие payload, могут принимать его в любом формате, а сами объекты могут быть приведены к простому типу при помощи вышеописанных методов.

Иными словами, можно пользоваться обоими подходами одновременно, работая с данными в любом удобном формате, не задумываясь о их преобразованиях - библиотека сделает всё сама.