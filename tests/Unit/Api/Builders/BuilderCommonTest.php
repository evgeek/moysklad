<?php

namespace Evgeek\Tests\Unit\Api\Builders;

use Evgeek\Moysklad\Api\Builders\BuilderCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\ApiTestCase;
use RuntimeException;

/** @covers \Evgeek\Moysklad\Api\Builders\BuilderCommon */
class BuilderCommonTest extends ApiTestCase
{
    public function testEmptySegmentPassed(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Passed $segment cannot be empty');
        new class($this->api, static::PREV_PATH, static::PARAMS, '') extends BuilderCommon {};
    }

    public function testNotEmptySegmentPassed(): void
    {
        $segment = 'test-segment';
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS, $segment) extends BuilderCommon {
            use GetTrait;
        };

        $path = [...static::PREV_PATH, $segment];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, static::PARAMS);
        $builder->get();
    }
}
