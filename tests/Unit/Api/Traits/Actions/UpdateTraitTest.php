<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Actions\UpdateTrait */
class UpdateTraitTest extends TraitTestCase
{
    public function testCallsApiClientWithCorrectPayload(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractSegmentNamed {
            use UpdateTrait;

            protected const SEGMENT = 'test_segment';
        };

        $this->expectsSendCalledWith(HttpMethod::PUT, static::PATH, static::PARAMS, static::BODY);
        $builder->update(static::BODY);
    }
}
