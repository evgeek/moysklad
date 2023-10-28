<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments;

use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;
use InvalidArgumentException;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment */
class AbstractCommonSegmentTest extends ApiTestCase
{
    public function testCannotConstructWithEmptySegmentPassed(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed $segment cannot be empty');

        new class($this->api, static::PREV_PATH, static::PARAMS, '') extends AbstractCommonSegment {};
    }

    public function testConstructedCallSendWithExpectedParams(): void
    {
        $segment = 'test-segment';
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS, $segment) extends AbstractCommonSegment {
        };

        $path = [...static::PREV_PATH, $segment];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, static::PARAMS);

        $builder->get();
    }
}
