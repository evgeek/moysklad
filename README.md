# SDK для работы с API v1.2 сервиса "Мой Склад"

Лёгкая и универсальная библиотека, позволяющий работать с [API 1.2](https://dev.moysklad.ru/doc/api/remap/1.2) и `PHP 8.1+`.

Находится в разработке, версии до `v1.0.0` могут не обладать обратной совместимостью. Список изменений можно найти в [Changelog](CHANGELOG.md). Инструкция по обновлению для версий, не поддерживающих обратную совместимость - [Upgrade guide](UPGRADE.md).

## Установка

```bash
composer require evgeek/moysklad
```

## Пример использования

```php
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\ApiObjects\Objects\Product;

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

* Настройка клиента (ССЫЛКА)
* Конструктор запросов (ССЫЛКА)
* Объекты (Active Record) (ССЫЛКА)
* Форматтеры (ССЫЛКА)
* Вспомогательные инструменты (ССЫЛКА)

## Особенности

Библиотека предоставляет два подхода к работе с API - Конструктор запросов и Объектный (Active Record). Подходы полностью совместимы и взаимозаменяемы.

### Query builder

Позволяет при помощи fluent-цепочки методов собрать любой запрос к API. 

![query-builder](/docs/query_builder.gif)