<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Builders\BuilderNamed;
use Evgeek\Moysklad\Api\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Actions\DeleteTrait */
class DeleteTraitTest extends TraitTestCase
{
    public function testCreate(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends BuilderNamed {
            use DeleteTrait;
            protected const NAME = 'test_segment';
        };

        $this->expectsApiSendCalledWith(HttpMethod::DELETE, static::PATH, static::PARAMS);
        $builder->delete();
    }
}
