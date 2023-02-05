<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Actions\CreateTrait */
class CreateTraitTest extends TraitTestCase
{
    public function testCreate(): void
    {
        $this->expectsApiSendCalledWith(HttpMethod::POST, static::PATH, static::PARAMS, static::BODY);

        $this->builder->create(static::BODY);
    }
}
