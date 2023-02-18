<?php

namespace Evgeek\Tests\Unit\Api\Segments\Endpoints;

use Evgeek\Moysklad\Api\Builder;
use Evgeek\Moysklad\Api\Segments\Endpoints\Entity;
use Evgeek\Moysklad\Api\Segments\Methods\Documents\Customerorder;
use Evgeek\Moysklad\Api\Segments\Methods\Entities\Assortment;
use Evgeek\Moysklad\Api\Segments\Methods\Entities\Product;
use Evgeek\Moysklad\Api\Segments\Methods\MethodNamed;
use Evgeek\Tests\Unit\Api\ApiTestCase;

/** @covers \Evgeek\Moysklad\Api\Segments\Endpoints\Entity<extended> */
class EntityTest extends ApiTestCase
{
    private Entity $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new Entity($this->api, [], []);
    }

    public function testProductReturnsCorrectClass(): void
    {
        $builder = $this->builder->product();

        $this->assertInstanceOf(Product::class, $builder);
        $this->assertInstanceOf(MethodNamed::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testCustomerorderReturnsCorrectClass(): void
    {
        $builder = $this->builder->customerorder();

        $this->assertInstanceOf(Customerorder::class, $builder);
        $this->assertInstanceOf(MethodNamed::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function testAssortmentReturnsCorrectClass(): void
    {
        $builder = $this->builder->assortment();

        $this->assertInstanceOf(Assortment::class, $builder);
        $this->assertInstanceOf(MethodNamed::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
