<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments;

use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentNamed;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;
use InvalidArgumentException;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentNamed */
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
