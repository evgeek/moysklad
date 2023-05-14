# Конструктор запросов

Простой, минимально абстрагированный от API Моего Склада способ собрать любой запрос. Для эффективного использования необходимо понимать, как работает API.

## Базовое использование

Конструктор запросов вызывается при помощи метода `query()` базового объекта библиотеки.

```php
use Evgeek\Moysklad\MoySklad;

$ms = new MoySklad(['token']);
$ms->query()->...;
```

Взаимодействовать с API можно как при помощи реализованных в библиотеке сущностей, так и при помощи универсальных методов, которые позволят собрать любой запрос. К примеру, запрос `GET https://online.moysklad.ru/api/remap/1.2/entity/customerorder/00001c03-5227-11e8-9ff4-315000132d57/positions?limit=2` можно построить так:

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

## Методы формирования url

### Сегменты

Делятся на три вида:

* `endpoint` - первый сегмент в ссылке после базового url. Примеры: `entity()`, `report()` - именные; `endpoint('entity)` - универсальный.
* `method` - сегменты, следующие после `endpoint`. Примеры: `customerorder()`, `positions()` - именные; `method('customerorder)` - универсальный.
* `id` - сегменты, содержащие guid-ы сущностей. Пример: `byId('00001c03-5227-11e8-9ff4-315000132d57')`.

Друг от друга методы сегментов отличаются набором имеющихся у них методов. Универсальные содержат все возможные методы, именные - только те, которыми обладает сущность, представляемая сегментом.

### Параметры запроса

* `limit($count)` - ограничение количества записей в ответе
* `offset($count)` - сдвиг для пагинации
* `search($text)` - контекстный поиск ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-kontextnyj-poisk))
* `expand($field)` - разворачивание вложенных сущностей ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand)). Несколько полей можно задать при помощи нескольких вызовов метода, или передав в метод массив с названиями полей. Помните, что разворачивание работает только с limit <= 100 и до 3-го уровня вложенности (ограничение API):

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

* `param($key, $value)` - универсальный метод, позволяющий сформировать любой параметр. Несколько параметров можно передать массивом массивов.

```php
$ms->query()
    ->param('search', 'orange')
    ->param([
        ['limit', 100],
        ['offset', 200],
    ]);
```

Нюансы:

* И `param()`, и специализированные методы при повторном вызове поддерживают дозапись в параметрах, где это возможно (`filter`, `expand`, `order`). В остальных параметрах ранее установленное значение перезаписывается.
* `filter()` автоматом экранирует `;`. `param()` - нет.

## Методы отправки запросов

Тело (`$body`) для запросов можно передавать в любом поддерживаемом формате (массив, stdClass, объект, json-строка).

* `send($method, $body)` - универсальный метод, позволяющий отправить любой HTTP запрос.

```php
$newProduct = $ms->query()
    ->entity()
    ->product()
    ->send('POST', ['name' => 'orange']);
```

* `create($body)` - `POST` запрос для создания сущности.

```php
$newProduct = $ms->query()
    ->entity()
    ->product()
    ->create(['name' => 'orange']);
```

* `get()` - `GET` запрос для получения сущности.

```php
$product = $ms->query()
    ->entity()
    ->product()
    ->byId('c7a48c56-f252-11ed-0a80-0f6000639033')
    ->get();
```

* `update($body)` - `PUT` запрос для обновления сущности.

```php
$updatedProduct = $ms->query()
    ->entity()
    ->product()
    ->byId('c7a48c56-f252-11ed-0a80-0f6000639033')
    ->update(['name' => 'tangerine']);
```

* `delete()` - `DELETE` запрос для удаления сущности.

```php
$ms->query()
    ->entity()
    ->product()
    ->byId('c7a48c56-f252-11ed-0a80-0f6000639033')
    ->delete();
```

* `massDelete($body)` - `POST` запрос для массового удаления. Тело запроса должно содержать массив удаляемых сущностей. Сущность может быть как получена из Моего Склада, так и сформирована при помощи соответствующего класса либо хелпера `Meta`.

```php
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Product;

$product1 = $ms->query()->entity()->product()->byId('cc181c35-f259-11ed-0a80-00e900658c8f')->get();
$product2 = Product::make($ms, ['id' => 'd540c409-f259-11ed-0a80-00e900658e53']);
$product3 = ['meta' => Meta::product('d540c409-f259-11ed-0a80-00e900658e53')];

$ms->query()
    ->entity()
    ->product()
    ->massDelete([$product1, $product2, $product3]);
```

## Универсальные методы

Методы, позволяющие сформировать и отправить любой запрос. Если в библиотеке пока нет нужного вам именного метода, воспользуйтесь ими. Подробности и примеры использования были рассмотрены выше.

* `endpoint($name)` - первый сегмент url, представляющий входную точку API.
* `method($name)` - последующие сегменты, представляющие сущности.
* `byId($guid)` - сегмент, представляющий конкретную сущность.
* `param($key, $value)` - query параметры url.
* `send($method, $body)` - отправка HTTP запроса.

## Итерация результатов

Перебор элементов коллекции, возвращаемой из API, является типичной задачей. Объекты коллекции содержатся в массиве `rows`. Таким образом, перебор полученного результата можно организовать следующим образом:

```php
$products = $ms->query()->entity()->product()->limit(100)->get();
foreach ($products->rows as $product) {
    var_dump($product->name);
}
```

Однако, если нужно перебрать всю коллекцию, размер которой больше лимита, коллекцию придётся запрашивать несколько раз. Сделать это можно так:

```php
$limit = 100;
$offset = 0;
$query = $ms->query()->entity()->product()->limit($limit);
$products = $query->get();

do {
    foreach ($products->rows as $product) {
        var_dump($product->name);
    }
    $products = $query->offset($offset += $limit)->get();
}  while ($products->rows);
```

Более лаконичной альтернативой является метод `getGenerator()`. Он возвращает генератор, перебирающий массив `rows` с текущего `offset` и до последнего элемента (с отправкой новых запросов, если это необходимо). Пагинация осуществляется с шагом `limit`.

```php
$generator = $ms->query()->entity()->product()->limit(100)->getGenerator();
foreach ($generator as $product) {
    var_dump($product->name);
}
```

## Отладка

Метод `debug()` позволяет посмотреть детали сформированного конструктором запроса без его реальной отправки. Просто разместите его перед любым `CRUD` методом, чтобы увидеть HTTP-метод, ссылку, заголовки и тело запроса:

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