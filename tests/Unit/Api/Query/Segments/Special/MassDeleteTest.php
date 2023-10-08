<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Special;

use Evgeek\Moysklad\Api\Query\Segments\Special\MassSegmentDelete;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\Special\MassSegmentDelete */
class MassDeleteTest extends ApiTestCase
{
    private const PATH = [
        ...self::PREV_PATH,
        'delete',
    ];
    private MassSegmentDelete $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new MassSegmentDelete($this->api, static::PREV_PATH, static::PARAMS);
    }

    public function testMassDeleteCallsApiClientWithCorrectPayload(): void
    {
        $this->expectsSendCalledWith(HttpMethod::POST, static::PATH, static::PARAMS, static::BODY);

        $this->builder->massDelete(static::BODY);
    }

    public function testMassDeleteDebugCallsApiClientWithCorrectPayload(): void
    {
        $this->expectsDebugCalledWith(HttpMethod::POST, static::PATH, static::PARAMS, static::BODY);

        $this->builder->massDeleteDebug(static::BODY);
    }
}
