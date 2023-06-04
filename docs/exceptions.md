# Обработка исключений

Исключения, генерируемые библиотекой.

* `InvalidArgumentException` - при передаче в методы некорректных параметров.
* `UnexpectedValueException` - при получении от API Моего Склада нестандартных ответов. В нормальной работе возникать не должно. Если вы с ним столкнулись - опишите, пожалуйста, в [issues](https://github.com/evgeek/moysklad/issues) обстоятельства.
* `Evgeek\Moysklad\Exceptions\RequestException` - обёртка для исключений HTTP запросов, генерируемых [Request Sender](/docs/setup.md#requestsenderfactory). Исходное исключение можно получить при помощи `getPrevious()`.

```php
try {
    $ms->query()->entity()->product()->method('new')->send('PUT');
} catch (RequestException $e) {
    $previous = $e->getPrevious();
    echo $previous->getMessage();
}
```

При использовании стандартной для библиотеки `GuzzleSenderFactory`, ответы с HTTP-кодами, отличными от 2xx и 3xx, выбрасывают исключения. Получить объекты запроса и ответа, а также тело ответа можно при помощи методов исключения Guzzle (см. [документацию](https://docs.guzzlephp.org/en/stable/quickstart.html)). Помните, что тело ответа отдаётся как stream, поэтому получить из него контент можно только один раз.

```php
try {
    $ms->query()->entity()->product()->method('new')->send('PUT');
} catch (RequestException $e) {
    /** @var \GuzzleHttp\Exception\ClientException $previous */
    $previous = $e->getPrevious();
    $request = $previous->getRequest();
    $response = $previous->getResponse();
    $content = $response->getBody()->getContents();
}
```

Аналогичного эффекта можно добиться, использовав методы исключения библиотеки. Контент в этом случае форматируется установленным форматтером и кэшируется (можно запросить многократно).

```php
try {
    $ms->query()->entity()->product()->method('new')->send('PUT');
} catch (RequestException $e) {
    $request = $e->getRequest();
    $response = $e->getResponse();
    $content = $e->getContent();
}
```

| - | [Оглавление](/docs/index.md) | - |
|:--|:----------------------------:|--:|