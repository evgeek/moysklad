<?php

namespace Evgeek\Tests\Unit;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Formatters\StringFormat;
use Evgeek\Moysklad\Http\RequestSenderFactoryInterface;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Tools\Meta;
use PHPUnit\Framework\TestCase;
use stdClass;

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

    public function testRequestSenderInitialization(): void
    {
        $requestSenderFactoryMock = $this->createMock(RequestSenderFactoryInterface::class);
        $ms = new MoySklad(['token']);

        $requestSenderFactoryMock->expects($this->once())
            ->method('make');

        $ms->__construct(credentials: ['token'], requestSenderFactory: $requestSenderFactoryMock);
    }

    public function testMetaFormatterInitialization(): void
    {
        new MoySklad(['token'], new ArrayFormat());
        $this->assertIsArray(Meta::organization('guid'));

        new MoySklad(['token'], new StringFormat());
        $this->assertIsString(Meta::organization('guid'));

        new MoySklad(['token'], new StdClassFormat());
        $this->assertInstanceOf(stdClass::class, Meta::organization('guid'));
    }
}
