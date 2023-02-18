<?php

namespace Evgeek\Tests\Unit\Api\Segments;

use Evgeek\Moysklad\Api\Segments\SegmentNamed;
use Evgeek\Tests\Unit\Api\ApiTestCase;
use RuntimeException;

/** @covers \Evgeek\Moysklad\Api\Segments\SegmentNamed */
class SegmentNamedTest extends ApiTestCase
{
    public function testCannotConstructWithEmptySegmentConstant(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('SEGMENT constant cannot be empty');

        new class($this->api, static::PREV_PATH, static::PARAMS) extends SegmentNamed {
            protected const SEGMENT = '';
        };
    }
}
