<?php

namespace Evgeek\Tests\Unit\Api;

use Evgeek\Moysklad\Api\Debug;
use Evgeek\Moysklad\Enums\HttpMethod;

/** @covers \Evgeek\Moysklad\Api\Debug<extended> */
class DebugTest extends ApiTestCase
{
    private Debug $debug;

    protected function setUp(): void
    {
        parent::setUp();

        $this->debug = new Debug($this->api, static::PREV_PATH, static::PARAMS);
    }

    public function testGetCallsApiClientWithCorrectPayload(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::GET);

        $this->debug->get();
    }

    public function testCreateCallsApiClientWithCorrectPayload(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true);

        $this->debug->create(static::BODY);
    }

    public function testUpdateCallsApiClientWithCorrectPayload(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::PUT, true);

        $this->debug->update(static::BODY);
    }

    public function testDeleteCallsApiClientWithCorrectPayload(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::DELETE);

        $this->debug->delete();
    }

    public function testMassDeleteCallsApiClientWithCorrectPayload(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true, 'delete');

        $this->debug->massDelete(static::BODY);
    }

    public function testSendCallsApiClientWithCorrectPayload(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true);

        $this->debug->send(HttpMethod::POST, static::BODY);
    }

    private function expectsApiDebugCalled(HttpMethod $method, bool $withBody = false, ?string $additionalPath = null): void
    {
        $path = $additionalPath ? array_merge(static::PREV_PATH, [$additionalPath]) : static::PREV_PATH;
        $body = $withBody ? static::BODY : null;

        $this->expectsDebugCalledWith($method, $path, static::PARAMS, $body);
    }
}
