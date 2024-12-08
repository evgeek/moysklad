# Upgrade guide

## v0.12.0 [[Changelog](/CHANGELOG.md#v0120-upgrade-guide)]

### Поправлен баг, из-за которого в Record-коллекциях пустое свойство rows конвертировалось в stdClass. Теперь оно остаётся пустым массивом.

В большинстве случаев, обратная совместимость не нарушится. Однако, если у вас по какой-то причине присуствует логика, по которой пустая коллекция определяется по типу свойства `rows` - этот подход придётся пересмотреть.

До:

```php
$collection = Product::collection($ms)->get();
if (is_a($collection->rows, stdClass::class)) {
    echo 'Коллекция пустая';
}
```

После:

```php
$collection = Product::collection($ms)->get();
if (count($collection->rows) === 0) {
    echo 'Коллекция пустая';
}
```

## v0.11.0 [[Changelog](/CHANGELOG.md#v0110-upgrade-guide)]

### Удалён класс `AttributeMetadata` и связанные с ним хелперы.

Для работы с `attributemetadata` используйте конструктор запросов. 

До:

```php
$attribute = AttributeMetadata::make($ms, ['id' => 'cb26a487-0f3a-11ee-0a80-060300137dbf'])->get();
$attributeList = AttributeMetadata::collection($ms)->get()->rows;
$meta = Meta::attributemetadata('cb26a487-0f3a-11ee-0a80-060300137dbf');
```

После:

```php
$attribute = $ms->query()
    ->entity()
    ->variant()
    ->metadata()
    ->characteristics()
    ->byId('cb26a487-0f3a-11ee-0a80-060300137dbf')
    ->get();
$attributeList = $ms->query()
    ->entity()
    ->variant()
    ->metadata()
    ->get()
    ->characteristics;
$meta = Meta::create(
    ['entity', 'variant', 'metadata', 'characteristics', 'cb26a487-0f3a-11ee-0a80-060300137dbf'],
    'attributemetadata',
);
```

## v0.10.0 [[Changelog](/CHANGELOG.md#v0100-upgrade-guide)]

### Имена классов Query и Record приведены к PascalCase. 

Затронуло только `Customerorder`

До:

- `use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CustomerorderSegment;`
- `use Evgeek\Moysklad\Api\Record\Objects\Documents\Customerorder;`
- `use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerorderCollection;`

После:

- `use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CustomerOrderSegment;`
- `use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;`
- `use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerOrderCollection;`

### Имена классов Query сегментов приведены к единому виду.

До:

- `use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdSegmentCommon;`
- `use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdSegmentPositioned;`
- `use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodSegmentNamed;`
- `use Evgeek\Moysklad\Api\Query\Segments\Methods\MethodSegmentCommon;`

После:

- `use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdCommonSegment;`
- `use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdWithPositionsSegment;`
- `use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;`
- `use Evgeek\Moysklad\Api\Query\Segments\Methods\MethodCommonSegment;`

### Словари (`Evgeek\Moysklad\Dictionaries\...`) `Document`, `Endpoint` и `Entity` заменены на `Segment` (сегменты в url) и `Type` (type в meta сущности).

До:

- `Endpoint::ENTITY;`
- `Document::CUSTOMERORDER;`

После:

- `Segment::ENTITY;`
- `Type::CUSTOMERORDER;`

## v0.8.0 [[Changelog](/CHANGELOG.md#v080-upgrade-guide)]

### Реорганизация namespace `Evgeek\Moysklad\Api`.

Данный namespace используется fluent-цепочкой билдера запросов (`$ms->query()->...`), поэтому изменения в нём не влияют на работу библиотеки. Однако, если ваш проект явно использует этот namespace, проверьте следующее:

До:

- `Evgeek\Moysklad\Api\Query`
- `Evgeek\Moysklad\Api\Segments\Special\MassDelete`
- `Evgeek\Moysklad\Api\Segments\...`
- `Evgeek\Moysklad\Api\Traits\Segments\...`

После:

- `Evgeek\Moysklad\Api\Query\QueryBuilder`
- `Evgeek\Moysklad\Api\Query\Segments\Special\MassDelete`
- `Evgeek\Moysklad\Api\Query\Segments\...`
- `Evgeek\Moysklad\Api\Query\Traits\Segments\...`

### Аргументы в методе `Meta::state()` приведены к общей логике.

До:

```php
Meta::state('25cf41f2-b068-11ed-0a80-0e9700500d7e', 'counterparty');
```

После:

```php
Meta::state('counterparty', '25cf41f2-b068-11ed-0a80-0e9700500d7e');
```

### Deprecated установки форматирования в хелпере `Meta`

До:

```php
Meta::setFormat(new ArrayFormat());
Meta::product('25cf41f2-b068-11ed-0a80-0e9700500d7e');
```

После:

```php
//Создание меты через основной объект MoySklad применит форматирование, заданное в MoySklad
$ms->meta()->product('25cf41f2-b068-11ed-0a80-0e9700500d7e');

//Альтернатива - явная передача форматтера в хелпер (по умолчанию - StdClassFormat)
Meta::product('25cf41f2-b068-11ed-0a80-0e9700500d7e', new ArrayFormat())
```

### Методы `Evgeek\Moysklad\Formatters\JsonFormatterInterface` теперь динамические.

Не требуется ничего менять, если вы не работали с форматтерами напрямую.

До:

```php
ArrayFormat::encode($entity);
StdClassFormat::decode($entity);
```

После:

```php
(new ArrayFormat())->encode($entity);
(new StdClassFormat())->decode($entity);
```

## v0.7.0 [[Changelog](/CHANGELOG.md#v070-upgrade-guide)]

### Приведение метода `expand()` к общей логике.

До:

```php
$ms->query()->entity()->customerorder()->byId('guid')
    ->expand('agent', 'organization');
```

После:

```php
$ms->query()->entity()->customerorder()->byId('guid')
    ->expand(['agent', 'organization']);
```

### DEPRECATED метода `filters()`.

До:

```php
$ms->query()->entity()->product()
    ->filters([
        ['minimumBalance', '=', '0'],
        ['code', FilterSign::NEQ, 123],
    ]);
```

После:

```php
$ms->query()->entity()->product()
    ->filter([
        ['minimumBalance', '=', '0'],
        ['code', FilterSign::NEQ, 123],
    ]);
```

### Форматтер инициализируется объектом, а не именем класса

Не требуется ничего менять, если вы не переопределяли стандартный формат.

До:

```php
$ms = new \Evgeek\Moysklad\MoySklad(
    formatter: \Evgeek\Moysklad\Formatters\StdClassFormat::class
);
```

После:

```php
$ms = new \Evgeek\Moysklad\MoySklad(
    formatter: new \Evgeek\Moysklad\Formatters\StdClassFormat()
);
```

### Настройка отправителя запросов реализована через фабрику

Не требуется ничего менять, если вы не переопределяли стандартный отправитель.

До:

```php
$ms = new \Evgeek\Moysklad\MoySklad(
    requestSender: new \Evgeek\Moysklad\Http\GuzzleSender()
);
```

После:

```php
$ms = new \Evgeek\Moysklad\MoySklad(
    requestSenderFactory: new \Evgeek\Moysklad\Http\GuzzleSenderFactory()
);
```

### Переработаны исключения

До:

- `Evgeek\Moysklad\Exceptions\ApiException`
- `Evgeek\Moysklad\Exceptions\InputException`
- `Evgeek\Moysklad\Exceptions\ConfigException`
- `Evgeek\Moysklad\Exceptions\FormatException`
- `Evgeek\Moysklad\Exceptions\GeneratorException`
- `Evgeek\Moysklad\Exceptions\AbstractException`

После:

- `Evgeek\Moysklad\Exceptions\RequestException`
- `InvalidArgumentException`
- `InvalidArgumentException`
- `InvalidArgumentException`
- `UnexpectedValueException`
- Удалён

### Реорганизация namespace `Evgeek\Moysklad\Api`.

Данный namespace используется fluent-цепочкой билдера запросов (`$ms->query()->...`), поэтому изменения в нём не влияют на работу библиотеки. Однако, если ваш проект явно использует этот namespace, проверьте следующее:

До:

- `Evgeek\Moysklad\Api\Builders\Methods\Special\Debug`
- `Evgeek\Moysklad\Api\Builders\Query`
- `Evgeek\Moysklad\Api\Builders\Methods\Special\MassDelete`
- `Evgeek\Moysklad\Api\Builders\...`
- `Evgeek\Moysklad\Api\Traits\Builders\...`

После:

- `Evgeek\Moysklad\Api\Debug`
- `Evgeek\Moysklad\Api\Query`
- `Evgeek\Moysklad\Api\Segments\Special\MassDelete`
- `Evgeek\Moysklad\Api\Segments\...`
- `Evgeek\Moysklad\Api\Traits\Segments\...`

### Namespace проекта приведён к [PSR Naming Conventions](https://www.php-fig.org/bylaws/psr-naming-conventions/).

Помимо `Evgeek\Moysklad\Formatters\JsonFormatterInterface`, прочие переименования, аналогично предыдущему пункту, не влияют на API библиотеки.

До:

- `Evgeek\Moysklad\Formatters\JsonFormatter`
- `Evgeek\Moysklad\Formatters\MultiDecoder`
- `Evgeek\Moysklad\Api\Builders\Builder`
- `Evgeek\Moysklad\Api\Builders\BuilderCommon`
- `Evgeek\Moysklad\Api\Builders\BuilderNamed`
- `Evgeek\Moysklad\Api\Builders\ById\ById`
- `Evgeek\Moysklad\Api\Builders\Endpoints\EndpointNamed`
- `Evgeek\Moysklad\Api\Builders\Methods\MethodNamed`

После:

- `Evgeek\Moysklad\Formatters\JsonFormatterInterface`
- `Evgeek\Moysklad\Formatters\AbstractMultiDecoder`
- `Evgeek\Moysklad\Api\AbstractBuilder`
- `Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon`
- `Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed`
- `Evgeek\Moysklad\Api\Segments\ById\AbstractById`
- `Evgeek\Moysklad\Api\Segments\Endpoints\AbstractEndpointNamed`
- `Evgeek\Moysklad\Api\Segments\Methods\AbstractMethodNamed`

## v0.6.0 [[Changelog](/CHANGELOG.md#v060-upgrade-guide)]

### Настройка форматирования

До:

```php
$ms = new \Evgeek\Moysklad\MoySklad(
    credentials: ['token'],
    format: \Evgeek\Moysklad\Enums\Format::OBJECT,
);
Meta::setFormat(\Evgeek\Moysklad\Enums\Format::ARRAY);
```

После:

```php
$ms = new \Evgeek\Moysklad\MoySklad(
    credentials: ['token'],
    formatter: \Evgeek\Moysklad\Formatters\StdClassFormat::class,
);
Meta::setFormat(\Evgeek\Moysklad\Formatters\ArrayFormat::class);
```

### Инициализация билдера

До:

```php
$ms->entity()->product();
```

После:

```php
$ms->query()->entity()->product();
```

### Фильтрация результатов

До:

```php
$product = $ms->entity()->product()->limit(1)->filter(
    (new \Evgeek\Moysklad\Filter())
        ->eq('archived', 'false')
        ->eq('name', 'tangerine')
        ->neq('code', '123')
);
```

После:

```php
$product = $ms->entity()->product()->limit(1)
    ->filter('archived', false)
    ->filter('name', '=', 'tangerine')
    ->filter('code', FilterSign::NEQ, 123);
    
//или
$product = $ms->query()->entity()->product()->limit(1)
    ->filters([
        ['archived', false],
        ['name', '=', 'tangerine'],
        ['code', FilterSign::NEQ, 123],
    ]);
```

## v0.5.1 [[Changelog](/CHANGELOG.md#v051-upgrade-guide)]

### `Meta::state()`

До:

```php
Meta::state($guid);
```

После:

```php
Meta::state($guid, 'customerorder');
```