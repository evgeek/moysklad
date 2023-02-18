<?php

namespace Evgeek\Tests\Unit\Api\Builders\Endpoints;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\Endpoints\Entity;
use Evgeek\Moysklad\Api\Builders\Methods\Documents\Customerorder;
use Evgeek\Moysklad\Api\Builders\Methods\Entities\Assortment;
use Evgeek\Moysklad\Api\Builders\Methods\Entities\Product;
use Evgeek\Moysklad\Api\Builders\Methods\MethodNamed;
use Evgeek\Tests\Unit\Api\ApiTestCase;

/** @covers \Evgeek\Moysklad\Api\Builders\Endpoints\Entity<extended> */
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
