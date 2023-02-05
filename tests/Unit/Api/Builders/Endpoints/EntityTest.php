<?php

namespace Evgeek\Tests\Unit\Api\Builders\Endpoints;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\Endpoints\Entity;
use Evgeek\Moysklad\Api\Builders\Methods\MethodNamed;
use Evgeek\Moysklad\Http\ApiClient;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Api\Builders\Endpoints\Entity<extended> */
class EntityTest extends TestCase
{
    private Entity $builder;

    public function setUp(): void
    {
        parent::setUp();

        $api = $this->getMockBuilder(ApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->builder = new Entity($api, [], []);
    }

    public function testProduct(): void
    {
        $product = $this->builder->product();

        $this->assertInstanceOf(Builder::class, $product);
        $this->assertInstanceOf(MethodNamed::class, $product);
    }

    public function testCustomerorder(): void
    {
        $customerorder = $this->builder->customerorder();

        $this->assertInstanceOf(Builder::class, $customerorder);
        $this->assertInstanceOf(MethodNamed::class, $customerorder);
    }

    public function testAssortment(): void
    {
        $assortment = $this->builder->assortment();

        $this->assertInstanceOf(Builder::class, $assortment);
        $this->assertInstanceOf(MethodNamed::class, $assortment);
    }
}
