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

    public function testProduct(): void
    {
        $product = $this->builder->product();

        $this->assertInstanceOf(Product::class, $product);
        $this->assertInstanceOf(MethodNamed::class, $product);
        $this->assertInstanceOf(Builder::class, $product);
    }

    public function testCustomerorder(): void
    {
        $customerorder = $this->builder->customerorder();

        $this->assertInstanceOf(Customerorder::class, $customerorder);
        $this->assertInstanceOf(MethodNamed::class, $customerorder);
        $this->assertInstanceOf(Builder::class, $customerorder);
    }

    public function testAssortment(): void
    {
        $assortment = $this->builder->assortment();

        $this->assertInstanceOf(Assortment::class, $assortment);
        $this->assertInstanceOf(MethodNamed::class, $assortment);
        $this->assertInstanceOf(Builder::class, $assortment);
    }
}
