<?php

namespace Evgeek\Tests\Unit\Api\Segments;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Tests\Unit\Api\ApiTestCase;
use RuntimeException;

/** @covers \Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed */
class AbstractSegmentNamedTest extends ApiTestCase
{
    public function testCannotConstructWithEmptySegmentConstant(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('SEGMENT constant cannot be empty');

        new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractSegmentNamed {
            protected const SEGMENT = '';
        };
    }
}
