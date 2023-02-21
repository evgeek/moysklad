<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\DebugTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Enums\QueryParam;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\UrlParam;
use Generator;
use InvalidArgumentException;

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

    protected function getEnumHttpMethod(HttpMethod|string $method): HttpMethod
    {
        if (!is_string($method)) {
            return $method;
        }

        $method = strtoupper($method);
        $enumMethod = HttpMethod::tryFrom($method);
        if ($enumMethod === null) {
            throw new InvalidArgumentException("'$method' is not valid HTTP method. Check " . HttpMethod::class);
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

    protected function setQueryParam(QueryParam|string $queryParam, string|int|float|bool $value): void
    {
        $stringQueryParam = strtolower(is_string($queryParam) ? $queryParam : $queryParam->value);
        $stringValue = UrlParam::convertMixedValueToString($value);

        $separator = QueryParam::getSeparator($stringQueryParam);
        if ($separator === '') {
            $this->params[$stringQueryParam] = $stringValue;

            return;
        }

        if (!array_key_exists($stringQueryParam, $this->params)) {
            $this->params[$stringQueryParam] = '';
        }
        $this->params[$stringQueryParam] .= $this->params[$stringQueryParam] === '' ?
            $stringValue :
            $separator . $stringValue;
    }
}
