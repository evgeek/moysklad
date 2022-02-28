<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\InputException;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\Payload;
use JetBrains\PhpStorm\Pure;
use SplQueue;

abstract class AbstractMethods
{
    protected readonly string $path;
    protected array $params = [];

    #[Pure]
    public function __construct(
        protected readonly ApiClient $api,
        protected readonly SplQueue $payloadList = new SplQueue()
    )
    {
    }

    protected function addPayloadToList(?HttpMethod $method = null, string|array|object|null $body = null): SplQueue
    {
        $this->payloadList->push($this->makePayload($method, $body));
        return $this->payloadList;
    }

    #[Pure]
    private function makePayload(?HttpMethod $method, string|array|object|null $body = null): Payload
    {
        return new Payload(
            method: $method,
            path: $this->path,
            params: $this->params,
            body: $body,
        );
    }

    /**
     * @throws FormatException
     * @throws ApiException
     */
    protected function apiSend(SplQueue $payloadList): object|array|string
    {
        return $this->api->send($this->payloadList);
    }

    /**
     * @throws FormatException
     */
    protected function apiDebug(SplQueue $payloadList): object|array|string
    {
        return $this->api->debug($this->payloadList);
    }

    /**
     * @throws InputException
     */
    protected function getEnumMethod(HttpMethod|string $method): HttpMethod
    {
        if (!is_string($method)) {
            return $method;
        }

        $enumMethod = HttpMethod::tryFrom($method);
        if ($enumMethod === null) {
            throw new InputException("'$method' is not valid HTTP method. " .
                "CheckEnums\HttpMethod");
        }

        return $enumMethod;
    }
}