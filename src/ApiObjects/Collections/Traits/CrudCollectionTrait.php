<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\Url;

trait CrudCollectionTrait
{
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
    public function massCreateUpdate(array $objects): static
    {
        return $this->sendAndWrapResponse(HttpMethod::POST, $objects);
    }

    /**
     * @throws RequestException
     */
    public function massDelete(array $objects): static
    {
        return $this->sendAndWrapResponse(HttpMethod::POST, $objects, 'delete');
    }

    /**
     * @throws RequestException
     */
    public function getNext(): ?static
    {
        $nextHref = $this->meta->nextHref ?? null;

        if (!$nextHref) {
            return null;
        }

        $this->meta->href = $nextHref;

        return $this->send(HttpMethod::GET);
    }

    /**
     * @throws RequestException
     */
    public function getPrevious(): ?static
    {
        $previousHref = $this->meta->previousHref ?? null;

        if (!$previousHref) {
            return null;
        }

        $this->meta->href = $previousHref;

        return $this->send(HttpMethod::GET);
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

    /**
     * @throws RequestException
     */
    protected function sendAndWrapResponse(HttpMethod $method, mixed $body, ?string $additionalSegment = null): static
    {
        $response = [];
        $meta = $this->meta ?? null;
        $context = $this->context ?? null;
        if ($meta) {
            $response['meta'] = $meta;
        }
        if ($context) {
            $response['context'] = $context;
        }

        $payload = $this->makePayload($method, $body, $additionalSegment);
        $response['rows'] = $this->ms->getApiClient()->send($payload);

        $this->hydrate($response);

        return $this;
    }

    protected function makePayload(HttpMethod $method, mixed $body, ?string $additionalSegment = null): Payload
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $path = $additionalSegment ?
            [...$path, $additionalSegment] :
            $path;

        return new Payload(
            method: $method,
            path: $path,
            params: $params,
            body: $body,
        );
    }
}
