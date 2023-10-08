<?php

namespace Evgeek\Tests\Unit\Api\Query;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\QueryBuilder;
use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\AccountSettingsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\AuditSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\ContextSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\EndpointCommonSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\EntitySegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\NotificationSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\ReportSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\MethodCommonSegment;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Query\AbstractBuilder
 * @covers \Evgeek\Moysklad\Api\Query\QueryBuilder
 */
class QueryBuilderTest extends ApiTestCase
{
    private QueryBuilder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new QueryBuilder($this->api);
    }

    public function testFromUrlReturnsCorrectClass(): void
    {
        $builder = $this->builder->fromUrl(Url::API . '/endpoint/segment');

        $this->assertInstanceOf(MethodCommonSegment::class, $builder);
        $this->assertInstanceOf(AbstractCommonSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testFromUrlWithInvalidUrlThrowsError(): void
    {
        $wrongUrl = 'wrong-url';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Url '$wrongUrl' does not belongs to Moysklad JSON API v1.2");

        $this->builder->fromUrl($wrongUrl);
    }

    public function testFromUrlDropParamsByDefault(): void
    {
        $ms = new MoySklad(['token']);
        $baseUrl = Url::API . '/endpoint/segment';
        $urlWithParams = $baseUrl . '?param=value';
        $url = $ms->query()->fromUrl($urlWithParams)->debug()->get()->url;

        $this->assertSame($baseUrl, $url);
    }

    public function testFromUrlPreserveParamsWithFlag(): void
    {
        $ms = new MoySklad(['token']);
        $baseUrl = Url::API . '/endpoint/segment';
        $urlWithParams = $baseUrl . '?param=value';
        $url = $ms->query()->fromUrl($urlWithParams, true)->debug()->get()->url;

        $this->assertSame($urlWithParams, $url);
    }

    public function testEndpointReturnsCorrectClass(): void
    {
        $builder = $this->builder->endpoint('test');

        $this->assertInstanceOf(EndpointCommonSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testEntityReturnsCorrectClass(): void
    {
        $builder = $this->builder->entity();

        $this->assertInstanceOf(EntitySegment::class, $builder);
        $this->assertInstanceOf(AbstractNamedSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testReportReturnsCorrectClass(): void
    {
        $builder = $this->builder->report();

        $this->assertInstanceOf(ReportSegment::class, $builder);
        $this->assertInstanceOf(AbstractNamedSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testAuditReturnsCorrectClass(): void
    {
        $builder = $this->builder->audit();

        $this->assertInstanceOf(AuditSegment::class, $builder);
        $this->assertInstanceOf(AbstractNamedSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testNotificationReturnsCorrectClass(): void
    {
        $builder = $this->builder->notification();

        $this->assertInstanceOf(NotificationSegment::class, $builder);
        $this->assertInstanceOf(AbstractNamedSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testContextReturnsCorrectClass(): void
    {
        $builder = $this->builder->context();

        $this->assertInstanceOf(ContextSegment::class, $builder);
        $this->assertInstanceOf(AbstractNamedSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testAccountSettingsReturnsCorrectClass(): void
    {
        $builder = $this->builder->accountSettings();

        $this->assertInstanceOf(AccountSettingsSegment::class, $builder);
        $this->assertInstanceOf(AbstractNamedSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
