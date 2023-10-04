<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait */
class MassDeleteTraitTest extends TraitTestCase
{
    public function testCallsApiClientWithCorrectPayload(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractNamedSegment {
            use MassDeleteTrait;

            protected const SEGMENT = 'test_segment';
        };

        $deletePath = [...static::PATH, 'delete'];
        $this->expectsSendCalledWith(HttpMethod::POST, $deletePath, static::PARAMS, static::BODY);
        $builder->massDelete(static::BODY);
    }
}
