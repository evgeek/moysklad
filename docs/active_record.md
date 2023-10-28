# Объектный подход (Record)

Основан на шаблоне Active Record. Объект Record представляет собой одну запись соответствующего типа в Моём Складе, коллекция - набор объектов.

* [Общая информация](/docs/active_record.md#общая-информация)
  * [Свойства](/docs/active_record.md#свойства)
  * [Приведение к простым типам](/docs/active_record.md#приведение-к-простым-типам)
* [Объекты](/docs/active_record.md#объекты)
  * [Инициализация объекта](/docs/active_record.md#инициализация-объекта)
  * [Параметры запроса объекта](/docs/active_record.md#параметры-запроса-объекта)
  * [Методы отправки запросов объекта](/docs/active_record.md#методы-отправки-запросов-объекта)
* [Коллекции](/docs/active_record.md#коллекции)
  * [Инициализация коллекции](/docs/active_record.md#инициализация-коллекции)
  * [Параметры запроса коллекций](/docs/active_record.md#параметры-запроса-коллекций)
  * [Методы отправки запросов коллекций](/docs/active_record.md#методы-отправки-запросов-коллекций)
  * [Итерирование](/docs/active_record.md#итерирование)
* [Вложенные сущности](/docs/active_record.md#вложенные-сущности)
* [Универсальные методы](/docs/active_record.md#универсальные-методы)
* [Расширяемость](/docs/active_record.md#расширяемость)

## Общая информация

### Свойства

В некоторых классах объектов и коллекций при помощи PHPDoc реализованы подсказки имён и типов свойств для IDE. Впрочем, даже если свойство ещё не добавлено в PHPDoc, с ним всё равно можно работать.

```php
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\MoySklad;

$ms = new MoySklad(['token']);
$product = Product::make($ms, ['name' => 'orange'])->create();
$product->unknownProperty = 123;

var_dump($product->id, $product->name, $product->unknownProperty);
//string(36) "5444e6f7-0300-11ee-0a80-046f00689371"
//string(6) "orange"
//int(123)
```

Устанавливаемые свойства автоматический преобразуются в объекты, если это возможно. Данные в формате Моего Склада будут преобразованы в `Record`, остальные - в `stdClass`.

```php
$product = Product::make($ms);
$product->owner = [
    'meta' => [
        'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/employee/f71b6eb9-a93d-11ed-0a80-0fba0011a679',
        'type' => 'employee',
    ],
];

echo $product->owner->meta->type . PHP_EOL;
//employee
echo $product->owner->get()->name . PHP_EOL;
//Evgeniy
```

### Приведение к простым типам

Любой Record можно привести к простому типу при помощи методов `toArray()`, `toString()` и `toStdClass()`. Это удобно для отладки.

```php
$product = Product::make($ms, ['name' => 'orange']);
var_dump($product->toArray());
```

## Объекты

Объект представляет собой сущность Моего Склада. Объект обладает свойствами сущности и методами для взаимодействия с API. Свойства могут быть как простыми типами (строка, число и т.д.), так и другими объектами.

### Инициализация объекта

Создать объект Record можно несколькими равноценными способами. Объект создаётся пустым, только со свойствами, переданными ему при инициализации, и автоматически устанавливаемыми метаданными. Для загрузки свойств из Моего Склада используйте [методы отправки запросов](/docs/active_record.md#методы-отправки-запросов-объекта).

```php
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;

$product1 = Product::make($ms);
$product2 = new Product($ms);
$product3 = $ms->record()->object()->product();
```

Задать свойства объекта можно как при инициализации, так и после:

```php
$product = Product::make($ms, ['name' => 'orange']);
$product->externalCode = '1234567';
```

### Параметры запроса объекта

* `expand($field)` - разворачивание вложенных сущностей ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand)). Несколько полей можно задать при помощи нескольких вызовов метода, или передав в метод массив с названиями полей.

```php
$product = Product::make($ms, ['id' => '66046520-f26f-11ed-0a80-0f6000692310'])
    ->expand('owner')
    ->expand(['group', 'images'])
    ->get();
```

### Методы отправки запросов объекта

Тело запроса формируется из свойств объекта. Все методы отправки запросов обновляют объект и возвращают его же.

* `create()` - `POST` запрос для создания сущности в Моём Складе. У сущности не должно быть id.

```php
$product = Product::make($ms, ['name' => 'orange'])->create();
//Или
$product = Product::make($ms);
$product->name = 'orange';
$product->create();

echo $product->id;
//c297fc79-0300-11ee-0a80-0350006b23fc
```

* `get()` - `GET` запрос, загружающий сущность из Моего Склада. У сущности должен быть задан id.

```php
$product = Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621'])
    ->get();
```

* `update($content)` - `PUT` запрос для обновления сущности. Изменяемые поля можно задать как через свойства класса, так и передав в качестве параметра метода в любом удобном формате (stdClass, массив, json-строка, Record). У сущности должен быть задан id.

```php
$product = Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621'])
    ->update(['name' => 'orange']);
//Или
$product = Product::make($ms);
$product->id = '9aa1b41b-f2fc-11ed-0a80-0f60007ec621';
$product->name = 'orange';
$product->update();
```

* `delete()` - `DELETE` запрос для удаления сущности. У сущности должен быть задан id.

```php
Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621'])
    ->delete();
```

## Коллекции

Коллекция представляет собой набор объектов Record.

### Инициализация коллекции

Инициализировать коллекцию можно несколькими равноценными способами. Коллекция создаётся пустой. Для загрузки свойств из Моего Склада используйте [методы отправки запросов](/docs/active_record.md#методы-отправки-запросов-коллекций).

```php
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;

$products1 = Product::collection($ms);
$products2 = new ProductCollection($ms);
$products3 = $ms->record()->collection()->product();
```

### Параметры запроса коллекций

* `limit($amount)` - ограничение количества записей в ответе.
* `offset($amount)` - сдвиг для пагинации.

```php
$products = Product::collection($ms)
    ->limit(100)
    ->offset(200);
```

* `search($text)` - контекстный поиск ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-kontextnyj-poisk)).

```php
Product::collection($ms)
    ->search('tangerine');
```

* `expand($field)` - разворачивание вложенных сущностей ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand)). Несколько полей можно задать при помощи нескольких вызовов метода, или передав в метод массив с названиями полей. Помните, что разворачивание работает только с limit <= 100 и до 3-го уровня вложенности (ограничение API).

```php
$products = Product::collection($ms)
    ->limit(100)
    ->expand('owner')
    ->expand(['group', 'images']);
```

* `filter()` - фильтрация результатов выдачи ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-fil-traciq-wyborki-s-pomosch-u-parametra-filter)). В метод можно передать три параметра (ключ, знак и значение), или только два (ключ и значение, в качестве знака по умолчанию будет использовано `=`). Знаком может быть строка (`'='`, `'!='` и пр.) или enum `Evgeek\Moysklad\Enums\FilterSign`. Несколько фильтров за раз можно передать как массив массивов с параметрами фильтрации.

```php
$products = Product::collection($ms)
    ->filter('archived', false)
    ->filter('name', '=~', 'apple')
    ->filter([
        ['minimumBalance', '=', '0'],
        ['code', FilterSign::NEQ, 123],
    ]);
```

* `order()` - сортировка ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-sortirowka-ob-ektow)). Если направление не задано, будет сортироваться по возрастанию (`asc`). Несколько сортировок можно передать или массивом массивов, или через несколько вызовов метода.

```php
$products = Product::collection($ms)
    ->order('updated', 'asc')
    ->order([
        ['code', 'desc'],
        ['name'],
    ]);
```

### Методы отправки запросов коллекций

Тело запроса формируется из свойств коллекции. Все методы отправки запросов обновляют объект коллекции и возвращают его же.

* `get()` - `GET` запрос, загружающий коллекцию из Моего Склада.

```php
$products = Product::collection($ms)->get();
```

* `getNext()` - `GET` запрос для загрузки следующей страницы коллекции. Если следующая страница отсутствует - вернёт `null`;
* `getPrevious()` - `GET` запрос для загрузки предыдущей страницы коллекции. Принцип работы аналогичен `getNext()`.

```php
$products = Product::collection($ms)->get();
$productNext = $product->getNext();
```

* `massDelete($objects)` - `POST` запрос для массового удаления. В метод требуется передать массив удаляемых сущностей в любом формате. Сущность может быть как получена из Моего Склада, так и сформирована при помощи соответствующего класса либо хелпера `Meta`. Вместо ручного формирования массива удаляемых сущностей, можно передать коллекцию, содержащую удаляемые сущности (или её свойство `rows`). Однако помните - удалены будут только сущности, загруженные в коллекцию, и если все подлежащие удалению сущности не вместились в лимит - потребуется вызывать удаление несколько раз, дозагружая сущности.

```php
$product1 = $ms->query()->entity()->product()->byId('cc181c35-f259-11ed-0a80-00e900658c8f')->get();
$product2 = Product::make($ms, ['id' => 'd540c409-f259-11ed-0a80-00e900658e53']);
$product3 = ['meta' => Meta::product('25cf41f2-b068-11ed-0a80-0e9700500d7e')];

Product::collection($ms)->massDelete([$product1, $product2, $product3]);

//Или
$oranges = Product::collection($ms)->search('orange')->get();
Product::collection($ms)->massDelete($oranges);
```

* `massCreateUpdate($objects)` - `POST` запрос для массового создания и/или обновления сущностей. Аналогично `massDelete()`, в качестве параметра требуется передать набор сущностей в любом формате, или коллекцию. Сущности с заданным id будут обновлены, без - созданы. Возвращает коллекцию, содержащую обновлённые объекты сущностей.

```php
$product1 = ['name' => 'Корнишоны'];
$product2 = Product::make($ms, [
    'id' => 'efcddaff-f308-11ed-0a80-09ee0084c2c6',
    'name' => 'Кабачки',
]);
$product3 = [
    'meta' => Meta::product('1a4d67b8-f309-11ed-0a80-086800825780'),
    'name' => 'Патиссоны',
];

$products = Product::collection($ms)
    ->massCreateUpdate([$product1, $product2, $product3]);

//Или
$updatableProducts = Product::collection($ms)->get();
$updatableProducts->each(function (Product $product) {
    $product->name = mb_strtoupper($product->name);
});
$products = Product::collection($ms)->massCreateUpdate($updatableProducts);
```

### Итерирование

Мой Склад возвращает объекты в коллекциях в свойстве `rows`, поэтому перебор объектов, загруженных в коллекцию, можно осуществить циклом - `foreach($collection->rows as $entity)`. Помимо этого, коллекции реализууют интерфейс `Iterator`, поэтому их можно итерировать напрямую - `foreach($collection as $entity)`.

Также можно воспользоваться методом `each()`, принимающим замыкание. Указывая тип сущности в замыкании, помните, что коллекции могут содержать разные сущности - допустим, `AssortmentCollection` может содержать товары, услуги, комплекты, серии и модификации.

```php
Product::collection($ms)
    ->get()
    ->each(function (Product $product) {
        echo $product->name . PHP_EOL;
    });
```

Вышеописанные способы подходят для перебора сущностей, загруженных в коллекцию. Если в Моём Складе сущностей больше, чем помещается в лимит, и требуется перебрать их все, необходимо организовать перебор API. Это можно сделать вручную, при помощи параметров запроса `limit()` и `offset()`, или при помощи методов `getNext()` и `getPrevious()`.

Также имеется более удобный метод `eachGenerator()`, который самостоятельно пройдёт по всему API, отправляя дополнительные запросы в случае необходимости. Метод учитывает параметры, заданные в `limit()` и `offset()`. В отличие от `each()`, коллекцию не нужно заранее загружать, метод сделает это сам.

```php
Product::collection($ms)
    ->limit(100)
    ->eachGenerator(function (Product $product) {
        echo $product->name . PHP_EOL;
    });
```

В случае, если вам обработать за раз сразу много объектов (допустим, изменить в Моём Складе, или записать в БД), взаимодействие с ними по одной в `eachGenerator()` может быть не лучшим с точки зрения производительности. Рассмотрите использование метода `eachCollectionGenerator()`. Он, подобно `eachGenerator()`, перебирает весь API, но в его замыкание объекты передаются не по одному, а сразу коллекциями. 

К примеру, перевести названия всех товаров в верхний регистр с минимальным количеством запросов к API можно следующим образом:

```php
Product::collection($ms)
    ->eachCollectionGenerator(function (ProductCollection $products) use ($ms) {
        $products->each(function (Product $product) {
            $product->name = mb_strtoupper($product->name);
        });
        Product::collection($ms)->massCreateUpdate($products);
    });
```

## Вложенные сущности

При инициализации сущностей, зависящих от других (файлы, изображения, сохранённые фильтры и др.), требуется указать родительскую сущность.

Если родительская сущность является коллекцией (последний сегмент url не является id), это можно сделать в следующих форматах:

```php
//Можно использовать объект Record, имя его класса, сегменты пути или type сущности
$product = Product::make($ms);
$product = Product::class;
$product = ['entity', 'product'];
$product = 'product';

//Получение коллекции вложенных сущностей
$productFilters = NamedFilter::collection($ms, $product)->get();

//Для получения конкретной сущности укажите её id
$productFilter = NamedFilter::make($ms, $product, [
    'id' => 'd9b8badf-2332-11ee-0a80-07e1001e2562'
])->get();
```

Если же родительская сущность является конкретным объектом (последний сегмент url является id), требуется сформировать её с id:

```php
//Можно использовать объект Record или сегменты пути
$product = Product::make($ms, ['id' => '8325d6cc-0838-11ee-0a80-08d500275db5']);
$product = ['entity', 'product', '8325d6cc-0838-11ee-0a80-08d500275db5'];

//Получение коллекции вложенных сущностей
$productImages = Image::collection($ms, $product)->get();

//Для получения конкретной сущности укажите её id
$productImage = Image::make($ms, $product, [
    'id' => 'fd016e22-9393-4d2c-b9d9-1d46d823f351'
])->get();
```

## Универсальные методы

Позволяют взаимодействовать с API в случае отсутствия нужных методов в библиотеке. 

* `param($key, $value)` - позволяет сформировать любой параметр запроса. Несколько параметров можно передать массивом массивов.

```php
Product::make($ms, ['id' => '66046520-f26f-11ed-0a80-0f6000692310'])
    ->param('expand', 'owner')
    ->param([
        ['expand', 'group'],
        ['expand', 'images,images.owner'],
    ])
```

* `send($method)` - позволяет отправить любой HTTP запрос. В качестве тела запроса будет отправлен сам объект.

```php
$product = Product::make($ms, ['id' => '825c1a20-f2ff-11ed-0a80-0868007fddf4']);
$product->name = 'tangerine';
$product->send('PUT');
```

## Расширяемость

Сущности Моего Склада, пока не реализованные в библиотеке, оборачиваются в `UnknownObject::class` и  `UnknownCollection::class`. Через них же можно создавать соответствующие объекты и коллекции, а также взаимодействовать с API. Для инициализации им необходим массив `$path` с сегментами url и строка `$type` с типом, из них формируется meta сущности.

```php
$report = UnknownObject::make($ms, ['report', 'money', 'plotseries'], 'moneyplotseries')
    ->param('momentFrom', '2023-01-01')
    ->param('momentTo', '2024-01-01')
    ->param('interval', 'month')
    ->get();

UnknownObject::collection($ms, ['entity', 'counterparty'], 'counterparty')
    ->eachGenerator(function (UnknownObject $counterparty) {
        echo $counterparty->name . PHP_EOL;
    });
```

Также вы можете регистрировать собственные классы сущностей, или расширять базовые. Подробнее об этом рассказано в разделе [Форматтеры](/docs/formatters.md).

| [<< Конструктор запросов (Query)](/docs/query_builder.md) | [Оглавление](/docs/index.md) | [Форматтеры >>](/docs/formatters.md) |
|:----------------------------------------------------------|:----------------------------:|-------------------------------------:|