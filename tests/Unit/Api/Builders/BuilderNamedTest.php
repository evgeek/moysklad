<?php

namespace Evgeek\Tests\Unit\Api\Builders;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\BuilderNamed;
use Evgeek\Moysklad\Api\Builders\Endpoints\Audit;
use Evgeek\Moysklad\Api\Builders\Endpoints\EndpointCommon;
use Evgeek\Moysklad\Api\Builders\Endpoints\EndpointNamed;
use Evgeek\Moysklad\Api\Builders\Endpoints\Entity;
use Evgeek\Moysklad\Api\Builders\Endpoints\Notification;
use Evgeek\Moysklad\Api\Builders\Endpoints\Report;
use Evgeek\Moysklad\Api\Builders\Query;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Exceptions\InputException;
use Evgeek\Tests\Unit\Api\ApiTestCase;
use RuntimeException;

/** @covers \Evgeek\Moysklad\Api\Builders\BuilderNamed */
class BuilderNamedTest extends ApiTestCase
{
    public function testEmptySegmentConstant(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('SEGMENT constant cannot be empty');
        new class($this->api, static::PREV_PATH, static::PARAMS) extends BuilderNamed {};
    }
}
