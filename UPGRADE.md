# Upgrade guide

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