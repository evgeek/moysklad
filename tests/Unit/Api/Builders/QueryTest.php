<?php

namespace Evgeek\Tests\Unit\Api\Builders;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\Query;
use Evgeek\Moysklad\Http\ApiClient;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Api\Builders\Query<extended> */
class QueryTest extends TestCase
{
    private Query $builder;
    public function setUp(): void
    {
        parent::setUp();

        $api = $this->getMockBuilder(ApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->builder = new Query($api);
    }

    public function testEndpoint(): void
    {
        $this->assertInstanceOf(Builder::class, $this->builder->endpoint('test'));
    }

    public function testEntity(): void
    {
        $this->assertInstanceOf(Builder::class, $this->builder->entity());
    }

    public function testReport(): void
    {
        $this->assertInstanceOf(Builder::class, $this->builder->report());
    }

    public function testAudit(): void
    {
        $this->assertInstanceOf(Builder::class, $this->builder->audit());
    }

    public function testNotification(): void
    {
        $this->assertInstanceOf(Builder::class, $this->builder->notification());
    }
}
