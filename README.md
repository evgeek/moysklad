# SDK для работы с API v1.2 сервиса "Мой Склад"

Идея этой библиотеки - максимально лёгкий и гибкий SDK, позволяющий работать с [API 1.2](https://dev.moysklad.ru/doc/api/remap/1.2) и `PHP 8.1+`.

Библиотека находится в разработке, версии до `v1.0.0` могут не обладать обратной совместимостью. Список изменений можно найти в [Changelog](CHANGELOG.md). Инструкция по обновлению для версий, не поддерживающих обратную совместимость - [Upgrade guide](UPGRADE.md).

## Установка

```bash
composer require evgeek/moysklad
```

## Настройка

```php
//Минимум
$ms = new \Evgeek\Moysklad\MoySklad(['token']);

//С подробностями
$ms = new \Evgeek\Moysklad\MoySklad(
    credentials: ['login', 'password'],
    formatter: \Evgeek\Moysklad\Formatters\StdClassFormat::class,
    requestSender: new \Evgeek\Moysklad\Http\GuzzleSender(retires: 3, exceptionTruncateAt: 4000)
);
```

* `credentials` - массив с учётными данными. Можно использовать либо токен, либо логин/пароль.
* `formatter` - имя класса, преобразующего json-строку ответа от API в нужный формат, и наоборот - передаваемый payload в json-строку. Должен реализовывать `\Evgeek\Moysklad\Formatters\JsonFormatterInterface`. Встроенные форматтеры - `StdClassFormat` (по умолчанию), `ArrayFormat`, и `StringFormat`. Все встроенные форматтеры могут принимать в качестве payload `stdClass`, `array` и `string`.
* `requestSender` - объект для отправки http-запросов. По умолчанию библиотека для этих целей использует [Guzzle](https://github.com/guzzle/guzzle). В стандартный `GuzzleSender()` в качестве аргументов можно передать желаемое количество попыток запроса (по умолчанию 1, задержка между повторами экспоненциальна) и максимальный размер сообщения об ошибке (по умолчанию 120 символов). Вы можете настроить клиент Guzzle самостоятельно, и передать его через метод `GuzzleSender::setClient()`. Использование Guzzle не обязательно: в качестве `requestSender` можно передать любой объект, реализующий простой `PSR-7` совместимый интерфейс `Evgeek\Moysklad\Http\RequestSenderInterface`.

## Базовое использование

Взаимодействовать с API можно как при помощи реализованных в SDK сущностей, так и при помощи универсальных методов, которые позволят собрать любой запрос. К примеру, запрос `GET https://online.moysklad.ru/api/remap/1.2/entity/customerorder/00001c03-5227-11e8-9ff4-315000132d57/positions?limit=2` можно реализовать так:

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
$ms->query()
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
* `byId()` - аналогично, шаг вложенности, но предназначен для идентификаторов сущностей. От `method()` отличается только набором методов.
* `param()` - для формирования query-параметров url
* `send()` - отправляет http-запрос и возвращает его результат. Параметры `method` и `body` позволяют задать http-метод запроса и его payload.

## Параметры запроса

Для формирования параметров запроса, помимо `param()`, есть несколько более удобных методов:

* `limit()` - ограничение количества записей в ответе
* `offset()` - сдвиг для пагинации
* `search()` - контекстный поиск ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-kontextnyj-poisk))
* `expand()` - разворачивание вложенных сущностей ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand)). Несколько полей можно задать при помощи нескольких вызовов метода, или передав в метод массив с названиями полей. Помните, что разворачивание работает только с limit <= 100 и до 3-го уровня вложенности (ограничение API):

```php
$ms->query()->entity()->product()
    ->limit(100)
    ->expand('owner')
    ->expand('minPrice.currency')
    ->expand(['group', 'images']);
```

* `filter()` - фильтрация результатов выдачи ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-fil-traciq-wyborki-s-pomosch-u-parametra-filter)). В метод можно передать три параметра (ключ, знак и значение), или только два (ключ и значение, в качестве знака по умолчанию будет использовано `=`). Знаком может быть строка (`'='`, `'!='` и пр.) или enum `Evgeek\Moysklad\Enums\FilterSign`. Несколько фильтров за раз можно передать как массив массивов с параметрами фильтрации:

```php
$product = $ms->query()->entity()->product()
    ->filter('archived', false)
    ->filter('name', '=~', 'apple')
    ->filter([
        ['minimumBalance', '=', '0'],
        ['code', FilterSign::NEQ, 123],
    ]);
```

* `order()` - сортировка ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-sortirowka-ob-ektow)). Если направление не задано, будет сортироваться по возрастанию (`asc`). Несколько сортировок можно передать или массивом массивов, или через несколько вызовов метода:

```php
$ms->query()->entity()->product()
    ->order('updated', 'asc')
    ->order([
       ['code', 'desc'],
       ['name'],
    ]);
```

Нюансы:

* И `param()`, и специализированные методы поддерживают дозапись в параметрах, где это возможно (`filter`, `expand`, `order`). В остальных параметрах ранее установленное значение перезаписывается.
* `param()`, аналогично прочим методам с дозаписью, поддерживает передачу нескольких наборов значений через массив массивов.
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

* `getGenerator()` - метод для итерируемых сущностей. Возвращает генератор, перебирающий массив `rows` с текущего `offset` и до последнего элемента (с отправкой новых запросов, если это необходимо). Пагинация осуществляется с шагом `limit`.

```php
$generator = $ms->query()->entity()->product()->limit(100)->search('orange')->getGenerator();
foreach ($generator as $product) {
    //...
}
```

* `debug()` - можно разместить перед любым `CRUD` методом, чтобы увидеть в подробностях, какой именно запрос будет отправлен:

```php
$product = $ms
    ->query()
    ->entity()
    ->product()
    ->limit(1)
    ->filter([
        ['archived', false],
        ['name', '!=', 'tangerine'],
    ])
    ->debug()
    ->get();
var_dump($product);
```

```bash
object(stdClass)#28 (5) {
  ["method"]=>
  string(3) "GET"
  ["url"]=>
  string(101) "https://online.moysklad.ru/api/remap/1.2/entity/product?limit=1&filter=archived=false;name!=tangerine"
  ["url_encoded"]=>
  string(109) "https://online.moysklad.ru/api/remap/1.2/entity/product?limit=1&filter=archived%3Dfalse%3Bname%21%3Dtangerine"
  ["headers"]=>
  object(stdClass)#29 (2) {
    ["Content-Type"]=>
    string(16) "application/json"
    ["Authorization"]=>
    string(38) "Basic ###############################"
  }
  ["body"]=>
  array(0) {
  }
}
```

## Вспомогательные классы

* `\Evgeek\Moysklad\Tools\Guid` - предназначен для работы с id (guid/uuid) сущностей:

```php
$url = 'https://online.moysklad.ru/api/remap/1.2/entity/customerorder/00001c03-5227-11e8-9ff4-315000132d57/positions/00002107-5227-11e8-9ff4-315000132d58';
var_dump(Guid::extractAll($url));
var_dump(Guid::extractFirst($url));
var_dump(Guid::extractLast($url));
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

Форматирование можно задать передав в метод `Meta::setFormat()` имя класса, реализующего `Evgeek\Moysklad\Formatters\JsonFormatterInterface`. По умолчанию используется `StdClassFormat`. Помните, что формат меты и формат ответа от API задаются в разных местах. Помимо небольшого набора предопределённых сущностей, можно сформировать любую мету при помощи универсального метода `Meta::create()` (и более узкого `Meta::entity()`). Примеры:

```php
Meta::setFormat(ArrayFormat::class);
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