<?php

namespace Evgeek\Tests\Feature\Api\Builders\Endpoints;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class EntityTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Endpoints\EntitySegment<extended>
     */
    public function testEndpointBuilder(): void
    {
        $this->assertNamedEndpointBuilder('entity');
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Endpoints\EntitySegment::product
     */
    public function testProductBuilder(): void
    {
        $actual = $this->query->entity()->product()->debug()->get();
        $expected = $this->makeExpectedDebug(['entity', 'product']);

        $this->assertSame($expected, $actual);
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Endpoints\EntitySegment::customerorder
     */
    public function testCustomerorderBuilder(): void
    {
        $actual = $this->query->entity()->customerorder()->debug()->get();
        $expected = $this->makeExpectedDebug(['entity', 'customerorder']);

        $this->assertSame($expected, $actual);
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Endpoints\EntitySegment::assortment
     */
    public function testAssortmentBuilder(): void
    {
        $actual = $this->query->entity()->assortment()->debug()->get();
        $expected = $this->makeExpectedDebug(['entity', 'assortment']);

        $this->assertSame($expected, $actual);
    }
}
