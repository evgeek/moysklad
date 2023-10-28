<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Enums\HttpMethod;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Collections\Traits\StateCrudCollectionTrait
 */
class StateCrudCollectionTraitTest extends CollectionTraitCase
{
    public function testCharacteristicsExtractsAsRows(): void
    {
        $state1 = State::make($this->ms, ['id' => static::GUID1]);
        $state2 = State::make($this->ms, ['id' => static::GUID2]);
        $response = CustomerOrder::make($this->ms, [
            'states' => [
                $state1,
                $state2,
            ],
        ]);

        $this->expectsSendCalledWith(
            HttpMethod::GET,
            ['entity', 'customerorder', 'metadata'],
            [],
            [],
            $response->toString()
        );

        $result = State::collection($this->ms, 'customerorder')->get();

        $this->assertNull($result->states);
        $this->assertSame($response->toArray()['states'], $result->toArray()['rows']);
        $this->assertSame($state1->toArray(), $result->rows[0]->toArray());
        $this->assertSame($state2->toArray(), $result->rows[1]->toArray());
    }
}
