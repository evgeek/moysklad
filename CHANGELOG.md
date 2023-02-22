# Changelog

Все заметные изменения в проекте будут задокументированы в этом файле. Формат основан на [Keep a Changelog](https://keepachangelog.com/ru), и этот проект придерживается семантического версионирования ([semver](https://semver.org/lang/ru/)).

## [Unreleased] [[Upgrade guide](/UPGRADE.md#[Unreleased]-changelog)]

### Added

- В методы для формирования query-параметров запроса, подразумеющих возможность передачи нескольких значений (`filter()`, `order()`, `expand()` и `params()`) можно передавать несколько наборов значений за раз при помощи массива массивов. Примеры есть в [README](/##параметры-запроса) и PHPDoc методов.
- Полное покрытие проекта unit тестами.

### Changed

- Приведение метода `expand()` к общей логике. Теперь у него только один аргумент, и есть возможность передать одновременно несколько полей через массив.
- Переработаны исключения: `ApiException` переименован в более логичный `RequestException`, остальные заменены стандартными `InvalidArgumentException` и `UnexpectedValueException`.
- Реорганизация namespace `Evgeek\Moysklad\Api`.
- Имена классов приведены к [PSR Naming Conventions](https://www.php-fig.org/bylaws/psr-naming-conventions/).
- Лог изменений приведён к [Keep a Changelog](https://keepachangelog.com/ru).

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