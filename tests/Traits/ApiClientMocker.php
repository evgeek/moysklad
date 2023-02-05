<?php

namespace Evgeek\Tests\Traits;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\Payload;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/** @mixin TestCase */
trait ApiClientMocker
{
    private MockObject|ApiClient $api;

    protected function createMockApiClient(): void
    {
        $this->api = $this->getMockBuilder(ApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function expectsApiSendCalledWith(HttpMethod $httpMethod, array $path, array $params, mixed $body = null): void
    {
        $this->mockApiClientMethodExpectsPayload('send', $httpMethod, $path, $params, $body);
    }

    private function expectsApiDebugCalledWith(HttpMethod $httpMethod, array $path, array $params, mixed $body = null): void
    {
        $this->mockApiClientMethodExpectsPayload('debug', $httpMethod, $path, $params, $body);
    }

    private function mockApiClientMethodExpectsPayload(string $method, HttpMethod $httpMethod, array $path, array $params, mixed $body): void
    {
        $this->api->expects($this->once())
            ->method($method)
            ->with($this->callback(
                fn(Payload $payload) =>
                    $payload->method === $httpMethod &&
                    $payload->path === $path &&
                    $payload->params === $params &&
                    $payload->body === $body
            ));
    }
}
