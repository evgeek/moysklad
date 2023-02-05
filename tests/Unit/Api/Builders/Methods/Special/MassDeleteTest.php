<?php

namespace Evgeek\Tests\Unit\Api\Builders\Methods\Special;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\Endpoints\Entity;
use Evgeek\Moysklad\Api\Builders\Methods\MethodNamed;
use Evgeek\Moysklad\Api\Builders\Methods\Special\Debug;
use Evgeek\Moysklad\Api\Builders\Methods\Special\MassDelete;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Tests\Traits\ApiClientMocker;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Api\Builders\Methods\Special\MassDelete<extended> */
class MassDeleteTest extends TestCase
{
    use ApiClientMocker;

    private MassDelete $builder;

    private const PREV_PATH = [
        'test_endpoint',
        'test_method',
    ];
    private const PATH = [
        'test_endpoint',
        'test_method',
        'delete',
    ];
    private const PARAMS = [
        'limit=1',
        'archived=false',
    ];
    private const BODY = [
        'name' => 'tangerine',
        'code' => '123456',
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->createMockApiClient();

        $this->builder = new MassDelete($this->api, self::PREV_PATH, self::PARAMS);
    }

    public function testMassDelete(): void
    {
        $this->expectsApiSendCalledWith(HttpMethod::POST, self::PATH, self::PARAMS, self::BODY);
        $this->builder->massDelete(self::BODY);
    }

    public function testMassDeleteDebug(): void
    {
        $this->expectsApiDebugCalledWith(HttpMethod::POST, self::PATH, self::PARAMS, self::BODY);
        $this->builder->massDeleteDebug(self::BODY);
    }
}
