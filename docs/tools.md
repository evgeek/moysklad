# Вспомогательные инструменты

Дополнительные классы, помогающие взаимодействовать с Моим Складом. Располагаются в пространстве имён `Evgeek\Moysklad\Tools`.

* [Meta](/docs/tools.md#meta)
  * [Методы сущностей](/docs/formatters.md#методы-сущностей)
  * [Форматирование](/docs/formatters.md#форматирование)
  * [Альтернатива](/docs/formatters.md#альтернатива)
* [Guid](/docs/tools.md#guid)

## Meta

Формирование метадаты сущностей. Полезен для формирования тела запроса в [Query](/docs/query_builder.md).

Хелпер можно использовать напрямую через статические методы класса, либо через метод `meta()` основного класса библиотеки. 

```php
$productMeta = Meta::product('757add1a-02c3-11ee-0a80-0bae005d263d');
//Или
$productMeta = $ms->meta()->product('e028f279-02c4-11ee-0a80-0022005cc7f4');

$product = [
    'meta' => $productMeta,
    'name' => 'lime',
];
$ms->query()->entity()->product()->massCreateUpdate([$product]);
```

### Методы сущностей

* Реализованные в библиотеке сущности вызываются при помощи одноимённых методов.

```php
$employeeMeta = $ms->meta()->employee('f77457f1-a93d-11ed-0a80-0fba0011a6f6');
$currencyMeta = Meta::currency('757add1a-02c3-11ee-0a80-0bae005d263d');
```

* `create($path, $type)` позволяет создать метадату для ещё не реализованных сущностей. `$path` - массив сегментов пути из поля `href` меты, `$type` - строка с названием типа сущности из поля `type` оттуда же.

```php
$serviceMeta = Meta::create(['entity', 'service'], 'service');
var_dump($serviceMeta);

//object(stdClass)#26 (3) {
//["href"]=>
//  string(55) "https://online.moysklad.ru/api/remap/1.2/entity/service"
//["type"]=>
//  string(7) "service"
//["mediaType"]=>
//  string(16) "application/json"
//}
```

### Форматирование

При использовании хелпера через `$ms->meta()`, результат возвращается в [формате](/docs/formatters.md), заданном в `$ms`. При использовани через статические методы, ответ возвращается в формате `stdClass`. Как правило, менять формат нет необходимости - однако, это можно сделать, передав желаемый форматтер в метод сущности.

```php
$productMeta = Meta::product('3aba2611-c64f-11ed-0a80-108a00230a9c', new StringFormat());
echo $productMeta;
//{"href":"https:\/\/online.moysklad.ru\/api\/remap\/1.2\/entity\/product\/3aba2611-c64f-11ed-0a80-108a00230a9c","type":"product","mediaType":"application\/json"}
```

### Альтернатива

Объекты [Record](/docs/active_record.md) формируют свою мету самостоятельно, поэтому их использование может быть удобнее, чем формирование тела запроса вручную.

```php
$product = [
    'meta' => $ms->meta()->product('3aba2611-c64f-11ed-0a80-108a00230a9c'),
    'name' => 'orange',
];

//Или
$product = Product::make($ms, [
    'id' => '3aba2611-c64f-11ed-0a80-108a00230a9c',
    'name' => 'orange',
]);
```


## Guid

Работа с id (guid/uuid) сущностей.

* `extractAll($url)` - возвращает массив со всеми id, извлечёнными из переданной строки `$url`.
* `extractFirst($url)` - возвращает первый id из переданной строки.
* `extractLast($url)` - возвращает последний id из переданной строки.
* `check($id)` - возвращает `true`, если переданный `$id` является валидным guid, иначе `false`.

```php
$url = 'https://online.moysklad.ru/api/remap/1.2/entity/customerorder/00001c03-5227-11e8-9ff4-315000132d57/positions/00002107-5227-11e8-9ff4-315000132d58';
var_dump(Guid::extractAll($url));
//array(2) {
//  [0]=>
//  string(36) "00001c03-5227-11e8-9ff4-315000132d57"
//  [1]=>
//  string(36) "00002107-5227-11e8-9ff4-315000132d58"
//}

$firstId = Guid::extractFirst($url);
echo $firstId;
//00001c03-5227-11e8-9ff4-315000132d57

var_dump(Guid::check($firstId));
//bool(true)
```