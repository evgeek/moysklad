# SDK для работы с API v1.2 сервиса "Мой Склад"

Лёгкая и универсальная библиотека, позволяющий работать с [API 1.2](https://dev.moysklad.ru/doc/api/remap/1.2) и `PHP 8.1+`.

Находится в разработке, версии до `v1.0.0` могут не обладать обратной совместимостью. Список изменений можно найти в [Changelog](CHANGELOG.md). Инструкция по обновлению для версий, не поддерживающих обратную совместимость - [Upgrade guide](UPGRADE.md).

## Установка

```bash
composer require evgeek/moysklad
```

## Быстрый старт

```php
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Product;use Evgeek\Moysklad\MoySklad;

$ms = new MoySklad(['token']);

//Конструктор запросов
$product = $ms->query()
    ->entity()
    ->product()
    ->byId('25cf41f2-b068-11ed-0a80-0e9700500d7e')
    ->get();

//Active Record
$product = Product::make($ms);
$product->id = '25cf41f2-b068-11ed-0a80-0e9700500d7e';
$product->get();
```

## Документация

* [Настройка клиента](/docs/setup.md)
* [Отправка запросов](/docs/queries.md)
* [Форматтеры](/docs/formatters.md)
* [Вспомогательные инструменты](/docs/tools.md)

## Особенности

Библиотека предоставляет два подхода к работе с API - Конструктор запросов и Объектный (Active Record). Подходы полностью совместимы и взаимозаменяемы.

### Конструктор запросов ([Документация](/docs/query_builder.md))

Позволяет при помощи fluent-цепочки методов собрать абсолютно любой запрос к API Моего Склада. 

```php
$products = $ms->query()
    ->entity()
    ->product()
    ->order('name')
    ->limit(3)
    ->get();

foreach ($products as $product) {
    var_dump($product->name);
}
```

### Объектный подход ([Документация](/docs/active_record.md))

Подход, основанный на концепции Active Record. Каждая сущность Моего Склада представлена отдельным классом, набор сущностей - коллекцией. Намного более лаконичный, хоть и чуть менее универсальный, чем конструктор запросов, способ взаимодействия с API. 

```php
Product::collection($ms)
    ->eachGenerator(function (Product $product) {
        $product->name = mb_strtoupper($product->name);
        $product->update();
    });
```

Из прочих плюсов - возможность расширять объекты сущностей собственными методами и автоподсказки свойств для IDE с глубокой вложенностью.

![autocomplete](/docs/autocomplete.gif)

### Документация

Публичные методы тщательно документированы: описание, примеры кода, ссылки на документацию библиотеки и/или API.

![comment](/docs/comments.png)

## Обратная связь

Буду рад видеть ваши идеи, пожелания и вопросы в [issues](https://github.com/evgeek/moysklad/issues).