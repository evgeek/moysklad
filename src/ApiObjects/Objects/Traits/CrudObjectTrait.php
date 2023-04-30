<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

trait CrudObjectTrait
{
    /**
     * @throws RequestException
     */
    public function get(): static
    {
        $id = Url::getId($this->meta->href);
        if (!$id) {
            throw new InvalidArgumentException('Cannot load object without id');
        }

        return $this->send(HttpMethod::GET);
    }

    /**
     * @throws RequestException
     */
    public function create(): static
    {
        $id = Url::getId($this->meta->href);
        if ($id) {
            throw new InvalidArgumentException('Cannot create object with id');
        }

        return $this->send(HttpMethod::POST);
    }

    /**
     * @throws RequestException
     */
    public function update(mixed $content = []): static
    {
        $id = Url::getId($this->meta->href);
        if (!$id) {
            throw new InvalidArgumentException('Cannot update object without id');
        }

        $this->hydrateAdd($content);

        return $this->send(HttpMethod::PUT);
    }

    /**
     * @throws RequestException
     */
    public function delete(): static
    {
        $id = Url::getId($this->meta->href);
        if (!$id) {
            throw new InvalidArgumentException('Cannot delete object without id');
        }

        return $this->send(HttpMethod::DELETE);
    }

    /**
     * @throws RequestException
     */
    protected function send(HttpMethod $method): static
    {
        $payload = $this->makePayload($method);

        $response = $this->ms->getApiClient()->send($payload);
        $this->hydrate($response);

        return $this;
    }

    protected function makePayload(HttpMethod $method): Payload
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);

        return new Payload(
            method: $method,
            path: $path,
            params: $params,
            body: $this,
        );
    }
}
