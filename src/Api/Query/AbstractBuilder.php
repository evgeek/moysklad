<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query;

use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\Payload;
use Generator;

abstract class AbstractBuilder
{
    protected array $path;

    public function __construct(
        protected readonly ApiClient $api,
        protected readonly array $prevPath,
        protected array $params
    ) {
        $this->path = $this->makeCurrentPath();
    }

    abstract protected function makeCurrentPath(): array;

    /**
     * @throws RequestException
     */
    protected function apiSend(HttpMethod $method, mixed $body = null)
    {
        return $this->api->send($this->makePayload($method, $body));
    }

    protected function apiDebug(HttpMethod $method, mixed $body = null)
    {
        return $this->api->debug($this->makePayload($method, $body));
    }

    /**
     * @throws RequestException
     */
    protected function apiGetGenerator(): Generator
    {
        return $this->api->getGenerator($this->makePayload(HttpMethod::GET));
    }

    protected function makePayload(HttpMethod $method, mixed $body = null): Payload
    {
        return new Payload(
            method: $method,
            path: $this->path,
            params: $this->params,
            body: $body,
        );
    }

    /**
     * @template T of AbstractCommonSegment
     *
     * @param class-string<T> $builderClass
     */
    protected function resolveCommonBuilder(string $builderClass, string $path): AbstractCommonSegment
    {
        return new $builderClass($this->api, $this->path, $this->params, $path);
    }

    /**
     * @template T of AbstractNamedSegment
     *
     * @param class-string<T> $builderClass
     */
    protected function resolveNamedBuilder(string $builderClass): AbstractNamedSegment
    {
        return new $builderClass($this->api, $this->path, $this->params);
    }
}
