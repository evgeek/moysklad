<?php

namespace Evgeek\Tests\Unit;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\Http\RequestSenderFactoryInterface;
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

    public function testRequestSenderInitialization(): void
    {
        $requestSenderFactoryMock = $this->createMock(RequestSenderFactoryInterface::class);

        $requestSenderFactoryMock->expects($this->once())
            ->method('make');

        new MoySklad(credentials: ['token'], requestSenderFactory: $requestSenderFactoryMock);
    }
}
