<?php

namespace Evgeek\Tests\Unit;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\ApiObjects\Builders\AbstractObjectBuilder;
use Evgeek\Moysklad\ApiObjects\Builders\ApiObjectBuilder;
use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\RequestSenderFactoryInterface;
use Evgeek\Moysklad\Meta\MetaMaker;
use Evgeek\Moysklad\MoySklad;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\MoySklad */
class MoySkladTest extends TestCase
{
    public function testQuery(): void
    {
        $ms = new MoySklad(['token']);
        $query = $ms->query();

        $this->assertInstanceOf(Query::class, $query);
        $this->assertInstanceOf(AbstractBuilder::class, $query);
    }

    public function testObject(): void
    {
        $ms = new MoySklad(['token']);
        $object = $ms->object();

        $this->assertInstanceOf(ApiObjectBuilder::class, $object);
        $this->assertInstanceOf(AbstractObjectBuilder::class, $object);
    }

    public function testMeta(): void
    {
        $ms = new MoySklad(['token']);
        $meta = $ms->meta();

        $this->assertInstanceOf(MetaMaker::class, $meta);
    }

    public function testGetApiClient(): void
    {
        $formatter = new ApiObjectFormatter();
        $ms = new MoySklad(['token'], $formatter);
        $apiClient = $ms->getApiClient();

        $this->assertInstanceOf(ApiClient::class, $apiClient);
        $this->assertSame($formatter, $apiClient->getFormatter());
    }

    public function testRequestSenderInitialization(): void
    {
        $requestSenderFactoryMock = $this->createMock(RequestSenderFactoryInterface::class);

        $requestSenderFactoryMock->expects($this->once())
            ->method('make');

        new MoySklad(credentials: ['token'], requestSenderFactory: $requestSenderFactoryMock);
    }
}
