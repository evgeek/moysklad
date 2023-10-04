<?php

namespace Evgeek\Tests\Unit\Api\Query;

use Evgeek\Moysklad\Api\Query\DebugBuilder;
use Evgeek\Moysklad\Enums\HttpMethod;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Query\AbstractBuilder
 * @covers \Evgeek\Moysklad\Api\Query\DebugBuilder
 */
class DebugTest extends ApiTestCase
{
    private DebugBuilder $debug;

    protected function setUp(): void
    {
        parent::setUp();

        $this->debug = new DebugBuilder($this->api, static::PREV_PATH, static::PARAMS);
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

    public function testMassCreateUpdateCallsApiClientWithCorrectPayload(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true);

        $this->debug->massCreateUpdate(static::BODY);
    }

    public function testSendCallsApiClientWithCorrectPayload(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true);

        $this->debug->send(HttpMethod::POST, static::BODY);
    }

    public function testSendCallsApiClientWithCorrectPayloadFromStringHttpMethod(): void
    {
        $this->expectsApiDebugCalled(HttpMethod::POST, true);

        $this->debug->send('post', static::BODY);
    }

    public function testCannotSendWrongStringHttpMethod(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("'WRONG-METHOD' is not valid HTTP method");

        $this->debug->send('WRONG-METHOD', static::BODY);
    }

    private function expectsApiDebugCalled(HttpMethod $method, bool $withBody = false, ?string $additionalPath = null): void
    {
        $path = $additionalPath ? array_merge(static::PREV_PATH, [$additionalPath]) : static::PREV_PATH;
        $body = $withBody ? static::BODY : null;

        $this->expectsDebugCalledWith($method, $path, static::PARAMS, $body);
    }
}
