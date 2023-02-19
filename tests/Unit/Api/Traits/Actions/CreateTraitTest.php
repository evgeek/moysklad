<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Actions\CreateTrait */
class CreateTraitTest extends TraitTestCase
{
    public function testCallsApiClientWithCorrectPayload(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractSegmentNamed {
            use CreateTrait;

            protected const SEGMENT = 'test_segment';
        };

        $this->expectsSendCalledWith(HttpMethod::POST, static::PATH, static::PARAMS, static::BODY);
        $builder->create(static::BODY);
    }
}
