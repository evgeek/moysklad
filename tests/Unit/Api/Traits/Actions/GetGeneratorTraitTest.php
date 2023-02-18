<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Builders\BuilderNamed;
use Evgeek\Moysklad\Api\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Api\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Actions\GetGeneratorTrait */
class GetGeneratorTraitTest extends TraitTestCase
{
    public function testGetGenerator(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends BuilderNamed {
            use GetGeneratorTrait;
            protected const NAME = 'test_segment';
        };

        $this->expectsGetGeneratorCalledWith(HttpMethod::GET, static::PATH, static::PARAMS);
        $builder->getGenerator();
    }
}
