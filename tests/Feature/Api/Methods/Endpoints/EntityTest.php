<?php

namespace Evgeek\Tests\Feature\Api\Methods\Endpoints;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class EntityTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\Entity<extended>
     */
    public function testEndpointBuilder(): void
    {
        $this->assertNamedEndpointBuilder('entity');
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\Entity::product
     */
    public function testProductBuilder(): void
    {
        $actual = $this->ms->entity()->product()->debug()->get();
        $expected = $this->makeExpectedDebug(['entity', 'product']);

        $this->assertSame($expected, $actual);
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\Entity::customerorder
     */
    public function testCustomerorderBuilder(): void
    {
        $actual = $this->ms->entity()->customerorder()->debug()->get();
        $expected = $this->makeExpectedDebug(['entity', 'customerorder']);

        $this->assertSame($expected, $actual);
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\Entity::assortment
     */
    public function testAssortmentBuilder(): void
    {
        $actual = $this->ms->entity()->assortment()->debug()->get();
        $expected = $this->makeExpectedDebug(['entity', 'assortment']);

        $this->assertSame($expected, $actual);
    }
}
