<?php

namespace Evgeek\Tests\Unit\Api\Segments;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Tests\Unit\Api\ApiTestCase;
use InvalidArgumentException;

/** @covers \Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed */
class AbstractSegmentNamedTest extends ApiTestCase
{
    public function testCannotConstructWithEmptySegmentConstant(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('SEGMENT constant cannot be empty');

        new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractSegmentNamed {
            protected const SEGMENT = '';
        };
    }
}
