<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Builders\BuilderNamed;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Actions\GetTrait */
class GetTraitTest extends TraitTestCase
{
    public function testGet(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends BuilderNamed {
            use GetTrait;
            protected const SEGMENT = 'test_segment';
        };

        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, static::PARAMS);
        $builder->get();
    }
}
