<?php

namespace Evgeek\Tests\Unit\Http;

use Evgeek\Moysklad\Http\GuzzleSender;
use Evgeek\Moysklad\Services\Url;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/** @covers \Evgeek\Moysklad\Http\DefaultGuzzleClientFactory */
class DefaultGuzzleClientFactoryTest extends TestCase
{
    public function testRetries(): void
    {
        $client = $this->createMock(Client::class);
        $guzzleSender = new GuzzleSender(2);
        $guzzleSender->setClient($client);

        $client->expects($this->exactly(2))
            ->method('send')
            ->willReturn(new Response(500));

        $guzzleSender->send(new Request('GET', Url::API));
    }
}
