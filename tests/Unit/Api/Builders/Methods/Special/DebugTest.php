<?php

namespace Evgeek\Tests\Unit\Api\Builders\Methods\Special;

use Evgeek\Moysklad\Api\Builders\Methods\Special\Debug;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\ApiTestCase;

/** @covers \Evgeek\Moysklad\Api\Builders\Methods\Special\Debug<extended> */
class DebugTest extends ApiTestCase
{
    private Debug $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new Debug($this->api, static::PREV_PATH, static::PARAMS);
    }

    public function testGet(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::GET);

        $this->builder->get();
    }

    public function testCreate(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true);

        $this->builder->create(static::BODY);
    }

    public function testUpdate(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::PUT, true);

        $this->builder->update(static::BODY);
    }

    public function testDelete(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::DELETE);

        $this->builder->delete();
    }

    public function testMassDelete(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true, 'delete');

        $this->builder->massDelete(static::BODY);
    }

    public function testSend(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true);

        $this->builder->send(HttpMethod::POST, static::BODY);
    }

    private function expectsApiDebugCalled(HttpMethod $method, bool $withBody = false, ?string $additionalPath = null): void
    {
        $path = $additionalPath ? array_merge(static::PREV_PATH, [$additionalPath]) : static::PREV_PATH;
        $body = $withBody ? static::BODY : null;

        $this->expectsDebugCalledWith($method, $path, static::PARAMS, $body);
    }
}
