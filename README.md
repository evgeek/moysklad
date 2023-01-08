# SDK для работы с API v1.2 Моего Склада

Идея этой библиотеки - максимально лёгкий и гибкий SDK, позволяющий работать
с [API 1.2](https://dev.moysklad.ru/doc/api/remap/1.2) и `PHP 8.1+` (к сожалению, не нашёл готовых решений, реализующих
сразу оба условия).

## Установка

```bash
$ composer require evgeek/moysklad
```

## Настройка

```php
//Минимум
$ms = new \Evgeek\Moysklad\MoySklad(['token']);

//С подробностями
$ms = new \Evgeek\Moysklad\MoySklad(
    credentials: ['login', 'password'],
    format: \Evgeek\Moysklad\Enums\Format::OBJECT,
    requestSender: new \Evgeek\Moysklad\Http\GuzzleSender()
);
```

* `credentials` - массив с учётными данными. Можно использовать либо токен, либо логин/пароль.
* `format` - формат ответа. Поддерживается `object` (по умолчанию), `array`, и `string`. Инициализируется через
  перечисление `Enums\Format`. Тело запроса можно передавать в любом из этих форматов, вне зависимости от формата
  ответа.
* `requestSender` - объект для отправки http-запросов. В библиотеке используется `Guzzle` - но можно использовать любой
  объект, реализующий простой `PSR-7` совместимый интерфейс `Evgeek\Moysklad\Http\RequestSenderInterface`.

## Базовое использование

Взаимодействовать с API можно как при помощи реализованных в SDK сущностей, так и при помощи универсальных методов,
которые позволят собрать любой запрос. К примеру,
запрос `GET https://online.moysklad.ru/api/remap/1.2/entity/customerorder/00001c03-5227-11e8-9ff4-315000132d57/positions?limit=2`
можно реализовать так:

```php
$ms->query()
    ->entity()
    ->customerorder()
    ->byId('00001c03-5227-11e8-9ff4-315000132d57')
    ->positions()
    ->limit(2)
    ->get();
```

Или так:

```php
$a = $ms->query()
    ->endpoint('entity')
    ->method('customerorder')
    ->byId('00001c03-5227-11e8-9ff4-315000132d57')
    ->method('positions')
    ->param('limit', '2')
    ->send('GET');
```

Список универсальных методов:

* `endpoint()` - входная точка api: `entity`, `report` и т д.
* `method()` - шаг вложенности url. Вложенностей может быть несколько
* `byId()` - аналогично, шаг вложенности, но предназначен для идентификаторов сущностей. От `method()` отличается только
  набором методов.
* `param()` - для формирования параметров запроса url
* `send()` - отправляет http-запрос и возвращает его результат. Параметры `method` и `body` позволяют задать http-метод
  запроса и его payload.

## Параметры запроса

Для формирования параметров запроса, помимо `param()`, есть несколько более удобных методов:

* `limit()` - ограничение количества записей в ответе
* `offset()` - сдвиг для пагинации
* `search()` - контекстный
  поиск ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-kontextnyj-poisk))
* `order()` -
  сортировка ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-sortirowka-ob-ektow)).
* `expand()` - разворачивание вложенных
  сущностей ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand))
  . Можно использовать несколькими способами:

```php
$product = $ms->query()->entity()->product()->limit(1);
$product = $product->expand('group,images');
$product = $product->expand('group', 'images');
$expand = ['group', 'images'];
$product = $product->expand(...$expand);
$product = $product
    ->expand('group')
    ->expand('images');
$result = $product->get();
```

* `filter()` - фильтрация результатов
  выдачи ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-fil-traciq-wyborki-s-pomosch-u-parametra-filter))
  . Формируется при помощи объекта `Evgeek\Moysklad\Filer`:

```php
$product = $ms->query()->entity()->product()->limit(1);
$product = $product->filter(
    (new \Evgeek\Moysklad\Filter())
        ->eq('archived', 'false')
        ->neq('name', 'мандарин')
);
```

Нюансы:

* И `param()`, и специализированные методы поддерживают дозапись в параметрах, где это возможно (`filter`, `expand`
  , `order`). В остальных параметрах ранее установленное значение перезаписывается.
* Параметры требуется добавлять в цепочку после последней сущности/id. Параметры, добавленные ранее, будут
  проигнорированы.
* `filter()` автоматом экранирует `;`. `param()` - нет.

## Отправка запросов

Помимо `send()`, для отправки http-запросов поддерживаются следующие методы:

* `get()` - `GET` запрос для чтения данных
* `create()` - `POST` запрос для создания сущности
* `update()` - `PUT` запрос для обновления сущности
* `delete()` - `DELETE` запрос для удаления сущности
* `massDelete()` - `POST` запрос для массового удаления

Тело для `POST` и `PUT` запросов можно передавать в любом поддерживаемом формате (массив, объект, json-строка).

#### Дополнительные методы:

* `getGenerator()` - метод для итерируемых сущностей. Возвращает генератор, перебирающий массив `rows` с
  текущего `offset` и до последнего элемента (с отправкой новых запросов, если это необходимо). Пагинация осуществляется
  с шагом `limit`.

```php
$generator = $ms->query()->entity()->product()->limit(100)->search('orange')->getGenerator();
foreach ($generator as $product) {
    //...
}
```

* `debug()` - можно разместить перед любым `CRUD` методом, чтобы увидеть в подробностях, какой именно запрос будет
  отправлен:

```php
$product = $ms
    ->query()
    ->entity()
    ->product()
    ->limit(1)
    ->filter(
        (new \Evgeek\Moysklad\Filter())
            ->eq('archived', 'false')
            ->neq('name', 'мандарин')
    )
    ->debug()
    ->get();
var_dump($product);
```

```bash
object(stdClass)#28 (5) {
  ["method"]=>
  string(3) "GET"
  ["url"]=>
  string(108) "https://online.moysklad.ru/api/remap/1.2/entity/product?limit=1&filter=archived=false;name!=мандарин"
  ["url_encoded"]=>
  string(148) "https://online.moysklad.ru/api/remap/1.2/entity/product?limit=1&filter=archived%3Dfalse%3Bname%21%3D%D0%BC%D0%B0%D0%BD%D0%B4%D0%B0%D1%80%D0%B8%D0%BD"
  ["headers"]=>
  object(stdClass)#27 (2) {
    ["Content-Type"]=>
    string(16) "application/json"
    ["Authorization"]=>
    string(38) "Basic #################################"
  }
  ["body"]=>
  string(0) ""
}
```

## Вспомогательные классы

* `\Evgeek\Moysklad\Tools\Guid` - предназначен для работы с id (guid/uuid) сущностей:

```php
$url = 'https://online.moysklad.ru/api/remap/1.2/entity/customerorder/00001c03-5227-11e8-9ff4-315000132d57/positions/00002107-5227-11e8-9ff4-315000132d58';
var_dump(\Evgeek\Moysklad\Tools\Guid::extractAll($url));
var_dump(\Evgeek\Moysklad\Tools\Guid::extractFirst($url));
var_dump(\Evgeek\Moysklad\Tools\Guid::extractLast($url));
```

```bash
array(2) {
  [0]=>
  string(36) "00001c03-5227-11e8-9ff4-315000132d57"
  [1]=>
  string(36) "00002107-5227-11e8-9ff4-315000132d58"
}
string(36) "00001c03-5227-11e8-9ff4-315000132d57"
string(36) "00002107-5227-11e8-9ff4-315000132d58"
```

* `\Evgeek\Moysklad\Tools\Meta` - помогает формировать метадату для создания новых объектов:

```php
var_dump(Meta::organization('ec008e5b-f5ab-11e5-7a69-970f0019fa50'));
```

```bash
object(stdClass)#19 (3) {
  ["href"]=>
  string(97) "https://online.moysklad.ru/api/remap/1.2/entity/organization/ec008e5b-f5ab-11e5-7a69-970f0019fa50"
  ["type"]=>
  string(12) "organization"
  ["mediaType"]=>
  string(16) "application/json"
}
```

Форматирование можно задать при помощи метода `Meta::setFormat()`. Помимо небольшого набора предопределённых сущностей,
можно сформировать любую мету при помощи универсального метода ```Meta::create()``` (и более
узкого ```Meta::entity()```). Примеры:

```php
Meta::setFormat(Format::ARRAY);
$order = [
    'name' => 'test_order',
    'organization' => ['meta' => Meta::create(['entity', 'organization', 'ec008e5b-f5ab-11e5-7a69-970f0019fa50'], 'organization')],
    'agent' => ['meta' => Meta::entity(['counterparty', '918e0c83-483c-11e7-7a69-93a700ee9dbd'], 'counterparty')],
];
var_dump($order);
```
```bash
array(3) {
  ["name"]=>
  string(10) "test_order"
  ["organization"]=>
  array(1) {
    ["meta"]=>
    array(3) {
      ["href"]=>
      string(97) "https://online.moysklad.ru/api/remap/1.2/entity/organization/ec008e5b-f5ab-11e5-7a69-970f0019fa50"
      ["type"]=>
      string(12) "organization"
      ["mediaType"]=>
      string(16) "application/json"
    }
  }
  ["agent"]=>
  array(1) {
    ["meta"]=>
    array(3) {
      ["href"]=>
      string(97) "https://online.moysklad.ru/api/remap/1.2/entity/counterparty/918e0c83-483c-11e7-7a69-93a700ee9dbd"
      ["type"]=>
      string(12) "counterparty"
      ["mediaType"]=>
      string(16) "application/json"
    }
  }
}
```