<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders;

use Evgeek\Moysklad\Api\Traits\Actions\DebugTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\GeneratorException;
use Evgeek\Moysklad\Exceptions\InputException;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\Payload;
use Generator;
use RuntimeException;
use stdClass;

abstract class Builder
{
    use DebugTrait;

    protected array $path;
    protected array $params = [];

    public function __construct(
        protected readonly ApiClient $api,
        protected readonly array $prevPath
    ) {
        $this->path = $this->makeCurrentPath();
    }

    abstract protected function makeCurrentPath(): array;

    /**
     * @throws FormatException
     * @throws ApiException
     */
    protected function apiSend(HttpMethod $method, stdClass|array|string|null $body = null): stdClass|array|string
    {
        return $this->api->send($this->makePayload($method, $body));
    }

    /**
     * @throws FormatException
     */
    protected function apiDebug(HttpMethod $method, stdClass|array|string|null $body = null): stdClass|array|string
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
    protected function getEnumMethod(HttpMethod|string $method): HttpMethod
    {
        if (!is_string($method)) {
            return $method;
        }

        $enumMethod = HttpMethod::tryFrom($method);
        if ($enumMethod === null) {
            throw new InputException("'$method' is not valid HTTP method. Check " . HttpMethod::class);
        }

        return $enumMethod;
    }

    protected function makePayload(HttpMethod $method, stdClass|array|string|null $body = null): Payload
    {
        return new Payload(
            method: $method,
            path: $this->path,
            params: $this->params,
            body: $body,
        );
    }

    /**
     * @template T of BuilderCommon
     *
     * @psalm-param class-string<T> $builderClass
     *
     * @return T
     */
    protected function resolveCommonBuilder(string $builderClass, string $path): BuilderCommon
    {
        if (!is_a($builderClass, BuilderCommon::class, true)) {
            throw new RuntimeException('Common builder resolving error');
        }

        return new $builderClass($this->api, $this->path, $path);
    }

    /**
     * @template T of BuilderNamed
     *
     * @psalm-param class-string<T> $builderClass
     *
     * @return T
     */
    protected function resolveNamedBuilder(string $builderClass): BuilderNamed
    {
        if (!is_a($builderClass, BuilderNamed::class, true)) {
            throw new RuntimeException('Named builder resolving error');
        }

        return new $builderClass($this->api, $this->path);
    }
}
