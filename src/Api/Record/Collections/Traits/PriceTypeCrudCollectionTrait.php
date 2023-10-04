<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Api\Record\Collections\Entities\PriceTypeCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\PriceType;
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\CollectionHelper;
use Evgeek\Moysklad\Services\NestedRecordHelper;
use Evgeek\Moysklad\Services\RecordHelper;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

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
