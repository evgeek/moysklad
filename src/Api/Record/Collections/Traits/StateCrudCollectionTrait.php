<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\Url;

trait StateCrudCollectionTrait
{
    /**
     * @throws RequestException
     */
    protected function send(HttpMethod $method, mixed $body = []): static
    {
        $payload = $this->makePayload($method, $body);
        $metadata = $this->ms->getApiClient()->send($payload);
        $stateCollection = $this->extractStateCollection($metadata);

        $this->hydrate($stateCollection);

        return $this;
    }

    protected function makePayload(HttpMethod $method, mixed $body, ?string $additionalSegment = null): Payload
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);

        if ($method === HttpMethod::GET) {
            array_pop($path);
        }

        $path = $additionalSegment ? [...$path, $additionalSegment] : $path;

        return new Payload(
            method: $method,
            path: $path,
            params: $params,
            body: $body,
        );
    }

    private function extractStateCollection(mixed $metadata)
    {
        $stdResponse = (new StdClassFormat())->encode($this->ms->getFormatter()->decode($metadata));

        [$parentPath] = Url::parsePathAndParams($stdResponse->meta->href);
        array_pop($parentPath);

        $statesCollection = State::collection($this->ms, $parentPath);
        $statesCollection->rows = $stdResponse->states;

        return $statesCollection;
    }
}
