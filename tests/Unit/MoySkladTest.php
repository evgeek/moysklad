<?php

namespace Evgeek\Tests\Unit;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\QueryBuilder;
use Evgeek\Moysklad\Api\Record\Builders\AbstractBuilder as AbstractRecordBuilder;
use Evgeek\Moysklad\Api\Record\Builders\RecordBuilder;
use Evgeek\Moysklad\Formatters\RecordFormat;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\RequestSenderFactoryInterface;
use Evgeek\Moysklad\Meta\MetaBuilder;
use Evgeek\Moysklad\MoySklad;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\MoySklad */
class MoySkladTest extends TestCase
{
    public function testQuery(): void
    {
        $ms = new MoySklad(['token']);
        $query = $ms->query();

        $this->assertInstanceOf(QueryBuilder::class, $query);
        $this->assertInstanceOf(AbstractBuilder::class, $query);
    }

    public function testObject(): void
    {
        $ms = new MoySklad(['token']);
        $object = $ms->record();

        $this->assertInstanceOf(RecordBuilder::class, $object);
        $this->assertInstanceOf(AbstractRecordBuilder::class, $object);
    }

    public function testMeta(): void
    {
        $ms = new MoySklad(['token']);
        $meta = $ms->meta();

        $this->assertInstanceOf(MetaBuilder::class, $meta);
    }

    public function testGetApiClient(): void
    {
        $ms = new MoySklad(['token']);
        $apiClient = $ms->getApiClient();

        $this->assertInstanceOf(ApiClient::class, $apiClient);
    }

    public function testGetFormatter(): void
    {
        $expectedFormatter = new RecordFormat();
        $ms = new MoySklad(['token'], $expectedFormatter);
        $formatter = $ms->getFormatter();

        $this->assertSame($expectedFormatter, $formatter);
    }

    public function testRequestSenderInitialization(): void
    {
        $requestSenderFactoryMock = $this->createMock(RequestSenderFactoryInterface::class);

        $requestSenderFactoryMock->expects($this->once())
            ->method('make');

        new MoySklad(credentials: ['token'], requestSenderFactory: $requestSenderFactoryMock);
    }
}
