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

    public function testEndpoint(): void
    {
        $endpoint = $this->builder->endpoint('test');

        $this->assertInstanceOf(EndpointCommon::class, $endpoint);
        $this->assertInstanceOf(Builder::class, $endpoint);
    }

    public function testEntity(): void
    {
        $entity = $this->builder->entity();

        $this->assertInstanceOf(Entity::class, $entity);
        $this->assertInstanceOf(EndpointNamed::class, $entity);
        $this->assertInstanceOf(Builder::class, $entity);
    }

    public function testReport(): void
    {
        $report = $this->builder->report();

        $this->assertInstanceOf(Report::class, $report);
        $this->assertInstanceOf(EndpointNamed::class, $report);
        $this->assertInstanceOf(Builder::class, $report);
    }

    public function testAudit(): void
    {
        $audit = $this->builder->audit();

        $this->assertInstanceOf(Audit::class, $audit);
        $this->assertInstanceOf(EndpointNamed::class, $audit);
        $this->assertInstanceOf(Builder::class, $audit);
    }

    public function testNotification(): void
    {
        $notification = $this->builder->notification();

        $this->assertInstanceOf(Notification::class, $notification);
        $this->assertInstanceOf(EndpointNamed::class, $notification);
        $this->assertInstanceOf(Builder::class, $notification);
    }
}
