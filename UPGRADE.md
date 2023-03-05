# Upgrade guide

## [Unreleased]

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
\Evgeek\Moysklad\Formatters\ArrayFormat::encode($entity);
\Evgeek\Moysklad\Formatters\ArrayFormat::decode($entity);
\Evgeek\Moysklad\Formatters\StringFormat::encode($entity);
\Evgeek\Moysklad\Formatters\StringFormat::decode($entity);
\Evgeek\Moysklad\Formatters\StdClassFormat::encode($entity);
\Evgeek\Moysklad\Formatters\StdClassFormat::decode($entity);
```

После:

```php
(new \Evgeek\Moysklad\Formatters\ArrayFormat())->encode($entity);
(new \Evgeek\Moysklad\Formatters\ArrayFormat())->decode($entity);
(new \Evgeek\Moysklad\Formatters\StringFormat())->encode($entity);
(new \Evgeek\Moysklad\Formatters\StringFormat())->decode($entity);
(new \Evgeek\Moysklad\Formatters\StdClassFormat())->encode($entity);
(new \Evgeek\Moysklad\Formatters\StdClassFormat())->decode($entity);
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