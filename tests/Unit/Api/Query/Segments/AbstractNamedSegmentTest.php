<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments;

use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;
use InvalidArgumentException;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment */
class AbstractNamedSegmentTest extends ApiTestCase
{
    public function testCannotConstructWithEmptySegmentConstant(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('SEGMENT constant cannot be empty');

        new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractNamedSegment {
            protected const SEGMENT = '';
        };
    }

    public function testConstructedCallSendWithExpectedParams(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractNamedSegment {
            protected const SEGMENT = 'test-segment';
        };

        $path = [...static::PREV_PATH, 'test-segment'];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, static::PARAMS);

        $builder->get();
    }
}
