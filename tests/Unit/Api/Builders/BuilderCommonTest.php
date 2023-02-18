<?php

namespace Evgeek\Tests\Unit\Api\Builders;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\BuilderCommon;
use Evgeek\Moysklad\Api\Builders\BuilderNamed;
use Evgeek\Moysklad\Api\Builders\Endpoints\Audit;
use Evgeek\Moysklad\Api\Builders\Endpoints\EndpointCommon;
use Evgeek\Moysklad\Api\Builders\Endpoints\EndpointNamed;
use Evgeek\Moysklad\Api\Builders\Endpoints\Entity;
use Evgeek\Moysklad\Api\Builders\Endpoints\Notification;
use Evgeek\Moysklad\Api\Builders\Endpoints\Report;
use Evgeek\Moysklad\Api\Builders\Query;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\InputException;
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
