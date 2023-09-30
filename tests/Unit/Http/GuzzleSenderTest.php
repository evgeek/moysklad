<?php

namespace Evgeek\Tests\Unit\Http;

use Evgeek\Moysklad\Http\GuzzleSender;
use Evgeek\Moysklad\Services\Url;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/** @covers \Evgeek\Moysklad\Http\GuzzleSender */
class GuzzleSenderTest extends TestCase
{
    public function testSenderUsesPassedClient(): void
    {
        $client = $this->createMock(Client::class);
        $guzzleSender = new GuzzleSender($client);

        $client->expects($this->once())
            ->method('send')
            ->with($this->callback(
                fn (RequestInterface $request) => $request->getMethod() === 'GET'
                    && $request->getUri()->getScheme() === 'https'
                    && $request->getUri()->getHost() === 'api.moysklad.ru'
                    && $request->getUri()->getPath() === '/api/remap/1.2'
                    && $request->getUri()->getQuery() === ''
                    && $request->getUri()->getFragment() === ''
                    && $request->getUri()->getPort() === null
            ));

        $guzzleSender->send(new Request('GET', Url::API));
    }
}
