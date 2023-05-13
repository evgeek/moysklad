# Настройка клиента

Основной объект для взаимодействия с API - `Evgeek\Moysklad\MoySklad`. В минимальной конфигурации ему требуется только массив с `credentials`.

```php
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Http\GuzzleSenderFactory;

//Минимум
$ms = new MoySklad(['token']);

//С подробностями
$ms = new MoySklad(
    credentials: ['login', 'password'],
    formatter: new StdClassFormat(),
    requestSenderFactory: new GuzzleSenderFactory(
        retries: 3, 
        exceptionTruncateAt: 4000
    )
);
```

### credentials

Массив, содержащий либо [токен](https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api), либо логин и пароль.

### formatter

Объект, преобразующий json-строку ответа от API в нужный формат, и наоборот - передаваемый payload в json-строку. Должен реализовывать `\Evgeek\Moysklad\Formatters\JsonFormatterInterface`. Встроенные форматтеры - `StdClassFormat` (по умолчанию), `ArrayFormat`, `StringFormat` и `ApiObjectFormatter`. Все встроенные форматтеры могут принимать в качестве payload `stdClass`, `array` и `string`.

Подробности касательно форматтеров можно найти в [соответствующем разделе](/docs/formatters.md) документации.

### requestSenderFactory

Фабрика, создающая объект для отправки HTTP запросов. Библиотека для этих целей использует [Guzzle](https://github.com/guzzle/guzzle). Фабрика внедряется через простой `PSR-7` совместимый интерфейс `Evgeek\Moysklad\Http\RequestSenderFactoryInterface`, поэтому не составит труда как просто настроить клиент Guzzle под свои предпочтения, так и реализовать собственный способ отправки.

Библиотека содержит встроенную фабрику `GuzzleSenderFactory()`, принимающую следующие аргументы:
* `retires` - количество повторных попыток отправки запроса в случае неудачи. По умолчанию 0 (одна отправка, без повторных попыток). Задержка между повторами экспоненциальна.
* `exceptionTruncateAt` - максимальный размер сообщения об ошибке. Значение Guzzle по умолчанию - 120 символов, что во многих ситуациях недостаточно.