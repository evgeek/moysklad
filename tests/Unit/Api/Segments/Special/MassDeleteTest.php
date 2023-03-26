<?php

namespace Evgeek\Tests\Unit\Api\Segments\Special;

use Evgeek\Moysklad\Api\Segments\Special\MassDeleteSegment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\ApiTestCase;

/** @covers \Evgeek\Moysklad\Api\Segments\Special\MassDeleteSegment */
class MassDeleteTest extends ApiTestCase
{
    private const PATH = [
        ...self::PREV_PATH,
        'delete',
    ];
    private MassDeleteSegment $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createMockApiClient();

        $this->builder = new MassDeleteSegment($this->api, static::PREV_PATH, static::PARAMS);
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
