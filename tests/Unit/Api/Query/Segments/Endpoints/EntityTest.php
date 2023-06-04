<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\EntitySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodSegmentNamed;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CustomerorderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\AssortmentSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\EmployeeSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProductSegment;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Query\AbstractBuilder
 * @covers \Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentNamed
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Endpoints\EntitySegment
 */
class EntityTest extends ApiTestCase
{
    private EntitySegment $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new EntitySegment($this->api, [], []);
    }

    public function testProductReturnsCorrectClass(): void
    {
        $builder = $this->builder->product();

        $this->assertInstanceOf(ProductSegment::class, $builder);
        $this->assertInstanceOf(AbstractMethodSegmentNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testCustomerorderReturnsCorrectClass(): void
    {
        $builder = $this->builder->customerorder();

        $this->assertInstanceOf(CustomerorderSegment::class, $builder);
        $this->assertInstanceOf(AbstractMethodSegmentNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testAssortmentReturnsCorrectClass(): void
    {
        $builder = $this->builder->assortment();

        $this->assertInstanceOf(AssortmentSegment::class, $builder);
        $this->assertInstanceOf(AbstractMethodSegmentNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }

    public function testEmployeeReturnsCorrectClass(): void
    {
        $builder = $this->builder->employee();

        $this->assertInstanceOf(EmployeeSegment::class, $builder);
        $this->assertInstanceOf(AbstractMethodSegmentNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
