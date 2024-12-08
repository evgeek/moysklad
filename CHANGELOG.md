# Changelog

Все существенные изменения в проекте будут задокументированы в этом файле. Формат основан на [Keep a Changelog](https://keepachangelog.com/), и этот проект придерживается семантического версионирования ([semver](https://semver.org/)).

## v0.12.0[[Upgrade guide](/UPGRADE.md#v0120-changelog)]

### Added

* В `GuzzleSender` при помощи параметра `$requestOptions` можно задавать параметры запросов по умолчанию - допустим, таймаут. Полный список параметров можно найти в [документации Guzzle](https://docs.guzzlephp.org/en/stable/request-options.html).

### Fixed

* Поправлен баг, из-за которого в Record-коллекциях пустое свойство `rows` конвертировалось в `stdClass`. Теперь оно остаётся пустым массивом. 

## v0.11.1

### Fixed

* Метод конструктора запросов `fromUrl()` теперь корректно обрабатывает имена query-параметров url с точками и нижними подчёркиваниями.

## v0.11.0[[Upgrade guide](/UPGRADE.md#v0110-changelog)]

### Removed

* Удалён класс `AttributeMetadata` и связанные с ним хелперы. Причина - у разных сущностей он доступен по разному пути, структура тоже отличается, поэтому его текущая реализация некорректна. Также в связи с нестандартным поведением, требует особую логику создания, что будет сделано позднее.

## v0.10.1

### Fixed

* В Query Builder возвращена возможность делать несколько последовательных вызовов `->byId()`

## v0.10.0 [[Upgrade guide](/UPGRADE.md#v0100-changelog)]

### Added

* Реализовано большинство сущностей Моего Склада - и в Конструкторе запросов, и в Record.
* debug-метод для `massCreateUpdate()`

### Changed

- Имена классов Record приведены к PascalCase.
- Имена классов Query сегментов приведены к единому виду.
- Словари `Document`, `Endpoint` и `Entity` заменены на `Segment` (сегменты в url) и `Type` (type в meta сущности).

## v0.9.1

### Changed

- `\Evgeek\Moysklad\Formatters\StringFormat::class` отныне не требует, чтобы ответ от API был в json формате. Это позволяет при помощи данного форматтера работать с любыми ответами, включая [файлы](https://github.com/evgeek/moysklad/issues/34).

## v0.9.0

### Changed

- В связи с [переездом API Моего Склада на новый домен](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-rekomendacii-po-pereezdu-na-nowyj-domen) внесены все необходимые правки: изменён url API, в заголовки добавлено gzip-сжатие. Пользователям библиотеки вносить какие-либо изменения в код в связи с этим не требуется. До 1 декабря 2023 года обновите версию библиотеки до `v0.9.0` или выше согласно [Upgrade guide](/UPGRADE.md).

## v0.8.2

### Fixed

- Исправлен [баг](https://github.com/evgeek/moysklad/issues/26) со строковым списком в объектах Record.

## v0.8.1

### Fixed

- Исправлен [баг](https://github.com/evgeek/moysklad/issues/27) со свойством `type` в объектах Record.

## v0.8.0 [[Upgrade guide](/UPGRADE.md#v080-changelog)]

### Added

- Реализована работа с API через [Active Record объекты](/docs/active_record.md).

```php
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\MoySklad;

$ms = new MoySklad(['token'])
$product = Product::make($ms, ['name' => 'orange'])->create();
$product->code = '1234567';
$product->update();
```

- В конструктор запросов добавлен метод `massCreateUpdate()`, позволяющий создавать и/или обновлять по нескольку объектов за раз.

- В конструктор запросов добавлен метод `fromUrl($url, $withParams)`, позволяющий строить запросы из уже имеющегося url:

```php
$orderUrl = 'https://online.moysklad.ru/api/remap/1.2/entity/customerorder/3aba2611-c64f-11ed-0a80-108a00230a9c'; 
$orderPositions = $ms
    ->query()
    ->fromUrl($orderUrl)
    ->positions()
    ->get();
```

- В ошибку запроса `Evgeek\Moysklad\Exceptions\RequestException` добавлены методы:
  - `getRequest()` - возвращает PSR-7 объект HTTP запроса, если он существует.
  - `getResponse()` - возвращает PSR-7 объект HTTP ответа, если он существует.
  - `getContent()` - Возвращает содержимое HTTP ответа, отформатированное текущим форматтером, или `null` в случае отсутствия содержимого.

### Changed

- Переписана документация.
- Реорганизация namespace `Evgeek\Moysklad\Api`.
- Методы `Evgeek\Moysklad\Formatters\JsonFormatterInterface` теперь динамические.
- Аргументы в методе `Meta::state()` приведены к общей логике.
- Максимальное количество символов ответа от API по умолчанию в `Evgeek\Moysklad\Http\GuzzleSenderFactory` увеличено до 4000.

### Removed

- Удалён устаревший метод `filters()`. Его функциональность теперь целиком возложена на `filter()`. 

### Deprecated

- Явная установка форматирования в хелпере `Meta`. 
- `Meta::entity()`. Вместо этого метода используйте `Meta::create()`.

## v0.7.0 [[Upgrade guide](/UPGRADE.md#v070-changelog)]

### Added

- В методы для формирования query-параметров запроса, подразумеющих возможность передачи нескольких значений (`filter()`, `order()`, `expand()` и `params()`) можно передавать несколько наборов значений за раз при помощи массива массивов. Примеры есть в [README](/##параметры-запроса) и PHPDoc методов.
- Полное покрытие проекта unit тестами.

### Changed

- Настройка отправителя запросов реализована через фабрику. Конструктор стандартной `Evgeek\Moysklad\Http\GuzzleSenderFactory` принимает параметры `$retries` и `$exceptionTruncateAt`, отвечающие за количество попыток повторной отправки запроса и лимит тела ответа в выбрасываемых исключениях соответственно.
- Форматтер инициализируется объектом, а не именем класса.
- Приведение метода `expand()` к общей логике. Теперь у него только один аргумент, и есть возможность передать одновременно несколько полей через массив.
- Переработаны исключения: `ApiException` переименован в более логичный `RequestException`, остальные заменены стандартными `InvalidArgumentException` и `UnexpectedValueException`.
- Реорганизация пространства имён `Evgeek\Moysklad\Api`.
- Имена классов приведены к [PSR Naming Conventions](https://www.php-fig.org/bylaws/psr-naming-conventions/).
- Лог изменений приведён к [Keep a Changelog](https://keepachangelog.com/ru).
- Тело ответа в исключениях, выбрасываемых неудачными запросами, теперь по умолчанию обрезается до 120 символов (ранее было 4000), изменить можно при помощи `GuzzleSenderFactory`.

### Deprecated

- В метод `filters()` будет удалён в следующей минорной версии, используйте вместо него `filter()`.

## v0.6.3

### Fixed

- Починен метод `Evgeek\Moysklad\Http\ApiClient::getGenerator()`.

## v0.6.2

### Fixed

- Форматтер `StdClassFormat` может обрабатывать не только объекты, но и массивы объектов.

## v0.6.1

### Fixed

- Небольшие фиксы документации.

## v0.6.0 [[Upgrade guide](/UPGRADE.md#v060-changelog)]

### Changed

- Формат ответа задаётся не через `\Evgeek\Moysklad\Enums\Format::class`, а через имя любого класса-форматтера, реализующего интерфейс  `Evgeek\Moysklad\Formatters\JsonFormatter`. Как и раньше, библиотека включает в себя три стандартных форматтера: `StdClassFormat` (по умолчанию), `ArrayFormat` и `StringFormat`, но теперь при желании можно реализовать свой собственный.
- Билдер запросов инициализируется не напрямую из `\Evgeek\Moysklad\MoySklad::class`, а через метод `MoySklad::query()`.
- Фильтры задаются более просто, без использования `Evgeek\Moysklad\Filter::class`.
- Параметры запроса (`->limit()`, `->filter()`, `->params()` и т.д.), которые ранее требовалось задавать исключительно в конце билдера, теперь корректно работают в любом месте fluent-цепочки.
- В качестве значения параметра в `filter()` и `param()` можно передавать не только строку, но и `bool|int|float`, переданное значение будет сконвертировано в строку автоматом (`123.45` => `'123.45'`, `true` => `'true'`).

## v0.5.2

### Added

- Добавлен PHPUnit и базовые тесты.

## v0.5.1 [[Upgrade guide](/UPGRADE.md#v051-changelog)]

### Changed

- Переработан метод `Meta::state()`. Ранее он создавал мету только для `customerorder`, теперь - для любой переданной сущности.

## v0.5.0

### Added

- Добавлен, настроен и запущен [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer).
- Добавлен и настроен [PHPStan](https://github.com/phpstan/phpstan), поправлены ошибки первого уровня.
- Добавлен `Makefile` с алиасами команд для быстрого запуска.