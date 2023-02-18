<?php

namespace Evgeek\Tests\Unit\Api\Segments;

use Evgeek\Moysklad\Api\Segments\SegmentCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\ApiTestCase;
use RuntimeException;

/** @covers \Evgeek\Moysklad\Api\Segments\SegmentCommon */
class SegmentCommonTest extends ApiTestCase
{
    public function testCannotConstructWithEmptySegmentPassed(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Passed $segment cannot be empty');

        new class($this->api, static::PREV_PATH, static::PARAMS, '') extends SegmentCommon {};
    }

    public function testCannotConstructWithNotEmptySegmentPassed(): void
    {
        $segment = 'test-segment';
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS, $segment) extends SegmentCommon {
            use GetTrait;
        };

        $path = [...static::PREV_PATH, $segment];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, static::PARAMS);

        $builder->get();
    }
}
