<?php

namespace Evgeek\Tests\Unit\Api;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\Api\Segments\Endpoints\AbstractEndpointNamed;
use Evgeek\Moysklad\Api\Segments\Endpoints\Audit;
use Evgeek\Moysklad\Api\Segments\Endpoints\EndpointCommon;
use Evgeek\Moysklad\Api\Segments\Endpoints\Entity;
use Evgeek\Moysklad\Api\Segments\Endpoints\Notification;
use Evgeek\Moysklad\Api\Segments\Endpoints\Report;

/** @covers \Evgeek\Moysklad\Api\Query<extended> */
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
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testEntityReturnsCorrectClass(): void
    {
        $builder = $this->builder->entity();

        $this->assertInstanceOf(Entity::class, $builder);
        $this->assertInstanceOf(AbstractEndpointNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testReportReturnsCorrectClass(): void
    {
        $builder = $this->builder->report();

        $this->assertInstanceOf(Report::class, $builder);
        $this->assertInstanceOf(AbstractEndpointNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testAuditReturnsCorrectClass(): void
    {
        $builder = $this->builder->audit();

        $this->assertInstanceOf(Audit::class, $builder);
        $this->assertInstanceOf(AbstractEndpointNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testNotificationReturnsCorrectClass(): void
    {
        $builder = $this->builder->notification();

        $this->assertInstanceOf(Notification::class, $builder);
        $this->assertInstanceOf(AbstractEndpointNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
