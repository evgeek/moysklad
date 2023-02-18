<?php

namespace Evgeek\Tests\Unit\Api\Builders;

use Evgeek\Moysklad\Api\Builders\BuilderNamed;
use Evgeek\Tests\Unit\Api\ApiTestCase;
use RuntimeException;

/** @covers \Evgeek\Moysklad\Api\Builders\BuilderNamed */
class BuilderNamedTest extends ApiTestCase
{
    public function testEmptySegmentConstant(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('SEGMENT constant cannot be empty');
        new class($this->api, static::PREV_PATH, static::PARAMS) extends BuilderNamed {};
    }
}
