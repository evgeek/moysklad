<?php

namespace Evgeek\Tests\Feature\Api\Builders\Methods\Special;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Feature\Api\ApiTestCase;
use InvalidArgumentException;

/**
 * @coversDefaultClass \Evgeek\Moysklad\Api\Debug
 */
class DebugTest extends ApiTestCase
{
    /**
     * @covers ::get
     */
    public function testGetReturns(): void
    {
        $this->assertDebugMethod('get', HttpMethod::GET);
    }

    /**
     * @covers ::create
     */
    public function testCreateReturns(): void
    {
        $this->assertDebugMethod('create', HttpMethod::POST, withBody: true);
    }

    /**
     * @covers ::update
     */
    public function testUpdateReturns(): void
    {
        $this->assertDebugMethod('update', HttpMethod::PUT, withBody: true);
    }

    /**
     * @covers ::delete
     */
    public function testDeleteReturns(): void
    {
        $this->assertDebugMethod('delete', HttpMethod::DELETE);
    }

    /**
     * @covers ::massDelete
     * @covers \Evgeek\Moysklad\Api\Segments\Special\MassDeleteSegment::massDeleteDebug
     */
    public function testMassDeleteReturns(): void
    {
        $this->assertDebugMethod('massDelete', HttpMethod::POST, withBody: true, isMassDelete: true);
    }

    /**
     * @covers ::send
     */
    public function testSendReturns(): void
    {
        $this->assertDebugMethod('send', HttpMethod::CONNECT, withBody: true, isSend: true);
    }

    /**
     * @covers ::send
     */
    public function testSendWithWrongMethod(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->query->endpoint('test_endpoint')->debug()->send('WRONG_METHOD');
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
        $debug = $this->query->endpoint($endpoint)->debug();

        $params = [];
        $isSend && $params[] = $httpMethod;
        $withBody && $params[] = $body;
        $actual = $debug->{$method}(...$params);

        $path = $isMassDelete ? [$endpoint, 'delete'] : [$endpoint];
        $expected = $this->makeExpectedDebug($path, $httpMethod, $withBody ? $body : null);

        $this->assertSame($expected, $actual);
    }
}
