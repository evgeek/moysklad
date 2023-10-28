<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Api\Record\Objects\Entities\PriceType;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;

trait PriceTypeCrudCollectionTrait
{
    /**
     * @throws RequestException
     */
    protected function send(HttpMethod $method, mixed $body = []): static
    {
        $payload = $this->makePayload($method, $body);
        $rows = $this->ms->getApiClient()->send($payload);
        $priceTypeCollection = $this->makePriceTypeCollection($rows);

        $this->hydrate($priceTypeCollection);

        return $this;
    }

    private function makePriceTypeCollection(array $rows)
    {
        $statesCollection = PriceType::collection($this->ms);
        $statesCollection->rows = $rows;

        return $statesCollection;
    }
}
