<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\DebugTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Enums\QueryParam;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\GeneratorException;
use Evgeek\Moysklad\Exceptions\InputException;
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
     * @throws FormatException
     * @throws ApiException
     */
    protected function apiSend(HttpMethod $method, mixed $body = null)
    {
        return $this->api->send($this->makePayload($method, $body));
    }

    /**
     * @throws FormatException
     */
    protected function apiDebug(HttpMethod $method, mixed $body = null)
    {
        return $this->api->debug($this->makePayload($method, $body));
    }

    /**
     * @throws FormatException
     * @throws GeneratorException
     * @throws ApiException
     */
    protected function apiGetGenerator(): Generator
    {
        return $this->api->getGenerator($this->makePayload(HttpMethod::GET));
    }

    /**
     * @throws InputException
     */
    protected function getEnumHttpMethod(HttpMethod|string $method): HttpMethod
    {
        if (!is_string($method)) {
            return $method;
        }

        $method = strtoupper($method);
        $enumMethod = HttpMethod::tryFrom($method);
        if ($enumMethod === null) {
            throw new InputException("'$method' is not valid HTTP method. Check " . HttpMethod::class);
        }

        return $enumMethod;
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
     * @psalm-param class-string<T> $builderClass
     *
     * @return T
     */
    protected function resolveCommonBuilder(string $builderClass, string $path): AbstractSegmentCommon
    {
        return new $builderClass($this->api, $this->path, $this->params, $path);
    }

    /**
     * @template T of AbstractSegmentNamed
     *
     * @psalm-param class-string<T> $builderClass
     *
     * @return T
     */
    protected function resolveNamedBuilder(string $builderClass): AbstractSegmentNamed
    {
        return new $builderClass($this->api, $this->path, $this->params);
    }

    protected function initQueryParam(QueryParam $queryParam): void
    {
        if (!array_key_exists($queryParam->value, $this->params)) {
            $this->params[$queryParam->value] = '';
        }
    }
}
