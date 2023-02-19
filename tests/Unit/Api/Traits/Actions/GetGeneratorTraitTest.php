<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\AbstractBuilder
 * @covers \Evgeek\Moysklad\Api\Traits\Actions\GetGeneratorTrait
 */
class GetGeneratorTraitTest extends TraitTestCase
{
    public function testCallsApiClientWithCorrectPayload(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractSegmentNamed {
            use GetGeneratorTrait;
            protected const SEGMENT = 'test_segment';
        };

        $this->expectsGetGeneratorCalledWith(HttpMethod::GET, static::PATH, static::PARAMS);
        $builder->getGenerator();
    }
}
