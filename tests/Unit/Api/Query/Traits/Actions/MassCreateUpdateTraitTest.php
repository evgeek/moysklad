<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassCreateUpdateTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Actions\MassCreateUpdateTrait */
class MassCreateUpdateTraitTest extends TraitTestCase
{
    public function testCallsApiClientWithCorrectPayload(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractNamedSegment {
            use MassCreateUpdateTrait;

            protected const SEGMENT = 'test_segment';
        };

        $this->expectsSendCalledWith(HttpMethod::POST, static::PATH, static::PARAMS, static::BODY);
        $builder->massCreateUpdate(static::BODY);
    }
}
