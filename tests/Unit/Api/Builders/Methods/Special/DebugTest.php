<?php

namespace Evgeek\Tests\Unit\Api\Builders\Methods\Special;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\Endpoints\Entity;
use Evgeek\Moysklad\Api\Builders\Methods\MethodNamed;
use Evgeek\Moysklad\Api\Builders\Methods\Special\Debug;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Tests\Traits\ApiClientMocker;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Api\Builders\Methods\Special\Debug<extended> */
class DebugTest extends TestCase
{
    use ApiClientMocker;

    private Debug $builder;

    private const PATH = [
        'test_endpoint',
        'test_method',
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

        $this->builder = new Debug($this->api, self::PATH, self::PARAMS);
    }

    public function testGet(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::GET);
        $this->builder->get();
    }

    public function testCreate(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true);
        $this->builder->create(self::BODY);
    }

    public function testUpdate(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::PUT, true);
        $this->builder->update(self::BODY);
    }

    public function testDelete(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::DELETE);
        $this->builder->delete();
    }

    public function testMassDelete(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true, 'delete');
        $this->builder->massDelete(self::BODY);
    }

    public function testSend(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true);
        $this->builder->send(HttpMethod::POST, self::BODY);
    }

    private function expectsApiDebugCalled(HttpMethod $method, bool $withBody = false, ?string $additionalPath = null): void
    {
        $path = $additionalPath ? array_merge(self::PATH, [$additionalPath]) : self::PATH;
        $body = $withBody ? self::BODY : null;

        $this->expectsApiDebugCalledWith($method, $path, self::PARAMS, $body);
    }
}
