# Объектный подход (Active Record)

Работа с API при помощи определённых в библиотеке классов сущностей и их коллекций. 

## Общая информация

### Свойства объектов

В классах сущностей и коллекций при помощи PHPDoc реализованы подсказки имён и типов свойств для ide. Впрочем, если свойство ещё не добавлено в PHPDoc, с ним всё равно можно работать.

```php
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Product;

$ms = new MoySklad(['token']);
$product = Product::make($ms, ['name' => 'orange'])->create();
$product->unknownProperty = 123;
var_dump($product->id, $product->name, $product->unknownProperty);
```

### Приведение к простым типам

Любой объект можно привести к простому типу при помощи методов `toArray()`, `toString()` и `toStdClass()`. Это удобно для отладки.

```php
$product = Product::make($ms, ['name' => 'orange']);
var_dump($product->toArray());
```

## Сущности

Сущность представляет собой объект Моего Склада, содержащий его свойства, и дополненный методами для взаимодействия с API. Свойства могут быть как простыми типами (строка, число и т.д.), так и другими объектами.

### Инициализация сущности

Создать объект класса сущности можно несколькими равноценными способами. Объект создаётся пустым, только со свойствами, переданными ему при инициализации. Для загрузки свойств из Моего Склада используйте [методы отправки запросов](/docs/active_record.md#методы-отправки-запросов-сущности).

```php
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Product;

$product1 = Product::make($ms);
$product2 = new Product($ms);
$product3 = $ms->object()->single()->product();
```

Задать свойства объекта можно как при инициализации, так и после:

```php
$product = Product::make($ms, ['name' => 'orange']);
$product->externalCode = '1234567';
```

### Параметры запроса сущности

* `expand($field)` - разворачивание вложенных сущностей ([doc](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand)). Несколько полей можно задать при помощи нескольких вызовов метода, или передав в метод массив с названиями полей.

```php
$product = Product::make($ms, ['id' => '66046520-f26f-11ed-0a80-0f6000692310'])
    ->expand('owner')
    ->expand(['group', 'images'])
    ->get();
```

### Методы отправки запросов сущности

Тело запроса формируется из свойств сущности. Если в сущности не задан id, считается, что она не существует в Моём Складе, и для неё доступен только метод `create()`. Если id задан, доступны все прочие CRUD-методы, кроме `create()`. Все методы отправки запросов обновляют сушность и возвращают её же.

* `create()` - `POST` запрос для создания сущности. 

```php
$product = Product::make($ms, ['name' => 'orange'])->create();
//Или
$product = Product::make($ms);
$product->name = 'orange';
$product->create();
```

* `get()` - `GET` запрос, загружающий сущность из Моего Склада.

```php
$product = Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621'])
    ->get();
```

* `update($content)` - `PUT` запрос для обновления сущности. Изменяемые поля можно задать как через свойства класса, так и передав в качестве параметра метода в любом удобном формате (stdClass, массив, json-строка, ApiObject).

```php
$product = Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621'])
    ->update(['name' => 'orange']);
//Или
$product = Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621']);
$product->name = 'orange';
$product->update();
```

* `delete()` - `DELETE` запрос для удаления сущности.

```php
Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621'])
    ->delete();
```

## Коллекции

Коллекция представляет собой набор объектов Моего Склада.

### Инициализация

Инициализировать коллекцию можно несколькими равноценными способами. Коллекция создаётся пустой. Для загрузки свойств из Моего Склада используйте [методы отправки запросов](/docs/active_record.md#методы-отправки-запросов-коллекций).

```php
use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Product;

$products1 = Product::collection($ms);
$products2 = new ProductCollection($ms);
$products3 = $ms->object()->collection()->product();
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

Тело запроса формируется из свойств коллекции. Все методы отправки запросов обновляют коллекцию и возвращают её же.

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

* `massDelete($objects)` - `POST` запрос для массового удаления. в метод требуется передать массив удаляемых сущностей в любом формате. Сущность может быть как получена из Моего Склада, так и сформирована при помощи соответствующего класса либо хелпера `Meta`. Вместо ручного формирования массива удаляемых объектов, в метод можно передать свойство `rows` коллекции, содержащей удаляемые объекты. Однако помните - удалены будут только сущности, загруженные в коллекцию, и если все подлежащие удалению сущности не вместились в лимит - потребуется вызывать удаление несколько раз, дозагружая сущности.

```php
$product1 = $ms->query()->entity()->product()->byId('cc181c35-f259-11ed-0a80-00e900658c8f')->get();
$product2 = Product::make($ms, ['id' => 'd540c409-f259-11ed-0a80-00e900658e53']);
$product3 = ['meta' => Meta::product('d540c409-f259-11ed-0a80-00e900658e53')];

Product::collection($ms)->massDelete([$product1, $product2, $product3]);

//Или
$oranges = Product::collection($ms)->search('orange')->get();
Product::collection($ms)->massDelete($oranges);
```

* `massCreateUpdate($objects)` - `POST` запрос для массового создания и/или обновления сущностей. Аналогично `massDelete()`, в качестве параметра требуется передать массив сущностей в любом формате, или свойство `rows` коллекции. Сущности с заданным id будут обновлены, без - созданы. Возвращает коллекцию, содержащую обновлённые объекты сущностей.

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

Мой Склад возвращает объекты в коллекциях в свойстве `rows`, поэтому перебор объектов, загруженных в коллекцию, можно осуществить циклом - `foreach($collection->rows as $entity)`.

Также можно воспользоваться методом `each()`, принимающим замыкание. Указывая тип сущности в замыкании, помните, что коллекции могут содержать разные сущности - допустим, `AssortmentCollection` может содержать товары, услуги, комплекты, серии и модификации.

```php
Product::collection($ms)
    ->get()
    ->each(function (Product $product) {
        echo $product->name . PHP_EOL;
    });
```

Вышеописанные способы подходят для перебора сущностей, загруженных в коллекцию. Если в Моём Складе сущностей больше, чем помещается в лимит, и требуется перебрать их все, необходимо организовать перебор API. Это можно сделать вручную, при помощи параметров запроса `limit()` и `offset()`, или при помощи методов `getNext()` и `getPrevious()`.

Также имеется более удобный метод, который самостоятельно пройдёт по всему API, отправляя дополнительные запросы в случае необходимости. Метод учитывает параметры, заданные в `limit()` и `offset()`. В отличие от `each()`, коллекцию не нужно заранее загружать, метод сделает это сам.

```php
Product::collection($ms)
    ->limit(100)
    ->eachGenerator(function (Product $product) {
        echo $product->name . PHP_EOL;
    });
```

В случае, если вам обработать за раз сразу много сущностей (допустим, изменить в Моём Складе, или записать в БД), взаимодействие с ними по одной в `eachGenerator()` может быть не лучшим с точки зрения производительности. Рассмотрите использование метода `eachCollectionGenerator()`. Он, подобно `eachGenerator()`, перебирает весь API, но в его замыкание сущности передаются не по одной, а сразу коллекциями. 

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

## Универсальные методы

На текущий момент, в библиотеке реализованы все методы параметров и запросов. Однако, в качестве запасного варианта оставлены универсальные методы.

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

Сущности Моего Склада, пока не реализованные в библиотеке, оборачиваются в `UnknownObject::class` и  `UnknownCollection::class`


!!!
Завис на следующем:
```php
$companySetting = (new UnknownObject($ms, ['context', 'companysettings'], 'companysettings'))->get();
var_dump($companySetting->toArray());

$p = Product::make($ms)->get();
var_dump($p->toArray());
```

Оказывается, есть объекты, которые можно получать без id (https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-kompanii-poluchit-nastrojki-kompanii).
Однако, у прочих в таких случаях возвращается коллекция, хоть и ожидается объект.
В настоящий момент я удалил исключения из CrudObjectTrait, которые гарантировали наличие/отсутствие id.
Варианты дальнейшего развития событий:
- Оставить как есть и считать, что никто не будет получать коллекции из объектов
- Возвращать из send свежезарезолвленный объект, а не текущий, чтобы в таких ситуациях объект бы подменялся (вроде, оптимально). В таком случае надо будет обратить на это внимание в документации.
- Вернуть эксепшны и сделать список исключений (ваще не универсально).

Надо разобраться с этой проблемой, после останется расписать расширяемость, сделать оглавление - и можно переходить к форматтерам.


# Расписать
* Инициализация
* CRUD с нюансом про id и дозаписывание меты
* Регистрация собственных классов
* Совместимость подходов


* Доделать CRUD методы
* Расписать в самих методах документацию
* Универсальные методы для коллекций и объектов (param, send)
* Оглавление (подумать, мб списки переделать на заголовки, чтобы включить их в оглавление)