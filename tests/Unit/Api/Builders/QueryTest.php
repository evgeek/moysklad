<?php

namespace Evgeek\Tests\Unit\Api\Builders;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\Endpoints\Audit;
use Evgeek\Moysklad\Api\Builders\Endpoints\EndpointCommon;
use Evgeek\Moysklad\Api\Builders\Endpoints\EndpointNamed;
use Evgeek\Moysklad\Api\Builders\Endpoints\Entity;
use Evgeek\Moysklad\Api\Builders\Endpoints\Notification;
use Evgeek\Moysklad\Api\Builders\Endpoints\Report;
use Evgeek\Moysklad\Api\Builders\Query;
use Evgeek\Tests\Unit\Api\ApiTestCase;

/** @covers \Evgeek\Moysklad\Api\Builders\Query<extended> */
class QueryTest extends ApiTestCase
{
    private Query $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new Query($this->api);
    }

    public function testEndpointReturnsCorrectClass(): void
    {
        $builder = $this->builder->endpoint('test');

        $this->assertInstanceOf(EndpointCommon::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testEntityReturnsCorrectClass(): void
    {
        $builder = $this->builder->entity();

        $this->assertInstanceOf(Entity::class, $builder);
        $this->assertInstanceOf(EndpointNamed::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testReportReturnsCorrectClass(): void
    {
        $builder = $this->builder->report();

        $this->assertInstanceOf(Report::class, $builder);
        $this->assertInstanceOf(EndpointNamed::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testAuditReturnsCorrectClass(): void
    {
        $builder = $this->builder->audit();

        $this->assertInstanceOf(Audit::class, $builder);
        $this->assertInstanceOf(EndpointNamed::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testNotificationReturnsCorrectClass(): void
    {
        $builder = $this->builder->notification();

        $this->assertInstanceOf(Notification::class, $builder);
        $this->assertInstanceOf(EndpointNamed::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
