<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\FillMetaCollectionTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

abstract class AbstractConcreteCollection extends AbstractConcreteApiObject
{
    use FillMetaCollectionTrait;

    /**
     * @throws RequestException
     */
    public function get(): static
    {
        return $this->send(HttpMethod::GET);
    }

    /**
     * @throws RequestException
     */
    public function create(array $objects): static
    {
        $meta = $this->meta ?? null;
        $context = $this->context ?? null;
        $payload = $this->makePayload(HttpMethod::POST, $objects);

        $response = [];
        if ($meta) {
            $response['meta'] = $meta;
        }
        if ($context) {
            $response['context'] = $context;
        }
        $response['rows'] = $this->ms->getApiClient()->send($payload);

        $this->hydrate($response);

        return $this;
    }

    /**
     * @throws RequestException
     */
    protected function send(HttpMethod $method, mixed $body = []): static
    {
        $payload = $this->makePayload($method, $body);

        $response = $this->ms->getApiClient()->send($payload);
        $this->hydrate($response);

        return $this;
    }

    protected function makePayload(HttpMethod $method, mixed $body): Payload
    {
        $href = $this->meta->href ?? null;
        if (!$href) {
            throw new InvalidArgumentException('Cannot find meta href');
        }

        [$path, $params] = Url::parsePathAndParams($href);

        return new Payload(
            method: $method,
            path: $path,
            params: $params,
            body: $body,
        );
    }
}
