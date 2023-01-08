<?php

namespace Evgeek\Tests\Feature\Api\Methods\Special;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Feature\Api\ApiTestCase;

/**
 * @coversDefaultClass \Evgeek\Moysklad\Api\Methods\Special\Debug
 */
class DebugTest extends ApiTestCase
{
    /**
     * @covers ::get
     */
    public function testGet(): void
    {
        $this->assertDebugMethod('get', HttpMethod::GET);
    }

    /**
     * @covers ::create
     */
    public function testCreate(): void
    {
        $this->assertDebugMethod('create', HttpMethod::POST, withBody: true);
    }

    /**
     * @covers ::update
     */
    public function testUpdate(): void
    {
        $this->assertDebugMethod('update', HttpMethod::PUT, withBody: true);
    }

    /**
     * @covers ::delete
     */
    public function testDelete(): void
    {
        $this->assertDebugMethod('delete', HttpMethod::DELETE);
    }

    /**
     * @covers ::massDelete
     */
    public function testMassDelete(): void
    {
        $this->assertDebugMethod('massDelete', HttpMethod::POST, withBody: true, isMassDelete: true);
    }

    /**
     * @covers ::send
     */
    public function testSend(): void
    {
        $this->assertDebugMethod('send', HttpMethod::CONNECT, withBody: true, isSend: true);
    }

    private function assertDebugMethod(
        string $method,
        HttpMethod $httpMethod,
        bool $withBody = false,
        bool $isMassDelete = false,
        bool $isSend = false
    ): void {
        $endpoint = 'test_endpoint';
        $body = ['test_body' => 'ok'];
        $debug = $this->ms->endpoint($endpoint)->debug();

        $params = [];
        $isSend && $params[] = $httpMethod;
        $withBody && $params[] = $body;
        $actual = $debug->{$method}(...$params);

        $path = $isMassDelete ? [$endpoint, 'delete'] : [$endpoint];
        $expected = $this->makeExpectedDebug($path, $httpMethod, $withBody ? $body : null);

        $this->assertSame($expected, $actual);
    }
}
