<?php

namespace Evgeek\Tests\Unit\Api;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\Api\Segments\Endpoints\AbstractEndpointSegmentNamed;
use Evgeek\Moysklad\Api\Segments\Endpoints\AuditSegment;
use Evgeek\Moysklad\Api\Segments\Endpoints\EndpointSegmentCommon;
use Evgeek\Moysklad\Api\Segments\Endpoints\EntitySegment;
use Evgeek\Moysklad\Api\Segments\Endpoints\NotificationSegment;
use Evgeek\Moysklad\Api\Segments\Endpoints\ReportSegment;

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

        $this->assertInstanceOf(EndpointSegmentCommon::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testEntityReturnsCorrectClass(): void
    {
        $builder = $this->builder->entity();

        $this->assertInstanceOf(EntitySegment::class, $builder);
        $this->assertInstanceOf(AbstractEndpointSegmentNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testReportReturnsCorrectClass(): void
    {
        $builder = $this->builder->report();

        $this->assertInstanceOf(ReportSegment::class, $builder);
        $this->assertInstanceOf(AbstractEndpointSegmentNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testAuditReturnsCorrectClass(): void
    {
        $builder = $this->builder->audit();

        $this->assertInstanceOf(AuditSegment::class, $builder);
        $this->assertInstanceOf(AbstractEndpointSegmentNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testNotificationReturnsCorrectClass(): void
    {
        $builder = $this->builder->notification();

        $this->assertInstanceOf(NotificationSegment::class, $builder);
        $this->assertInstanceOf(AbstractEndpointSegmentNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
