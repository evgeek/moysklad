<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments;

use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;
use InvalidArgumentException;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentCommon */
class AbstractSegmentCommonTest extends ApiTestCase
{
    public function testCannotConstructWithEmptySegmentPassed(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed $segment cannot be empty');

        new class($this->api, static::PREV_PATH, static::PARAMS, '') extends AbstractSegmentCommon {};
    }

    public function testCannotConstructWithNotEmptySegmentPassed(): void
    {
        $segment = 'test-segment';
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS, $segment) extends AbstractSegmentCommon {
            use GetTrait;
        };

        $path = [...static::PREV_PATH, $segment];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, static::PARAMS);

        $builder->get();
    }
}
