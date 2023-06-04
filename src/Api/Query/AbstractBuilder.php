<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query;

use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Query\Traits\Actions\DebugTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\Payload;
use Generator;

abstract class AbstractBuilder
{
    use DebugTrait;

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
     * @template T of AbstractSegmentCommon
     *
     * @param class-string<T> $builderClass
     */
    protected function resolveCommonBuilder(string $builderClass, string $path): AbstractSegmentCommon
    {
        return new $builderClass($this->api, $this->path, $this->params, $path);
    }

    /**
     * @template T of AbstractSegmentNamed
     *
     * @param class-string<T> $builderClass
     */
    protected function resolveNamedBuilder(string $builderClass): AbstractSegmentNamed
    {
        return new $builderClass($this->api, $this->path, $this->params);
    }
}
