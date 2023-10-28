<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Actions\DeleteTrait */
class DeleteTraitTest extends TraitTestCase
{
    public function testCallsApiClientWithCorrectPayload(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractNamedSegment {
            use DeleteTrait;

            protected const SEGMENT = 'test_segment';
        };

        $this->expectsSendCalledWith(HttpMethod::DELETE, static::PATH, static::PARAMS);
        $builder->delete();
    }
}
