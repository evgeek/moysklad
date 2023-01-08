<?php

namespace Evgeek\Tests\Feature\Api\Builders\Methods\Entities;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class AssortmentTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Builders\Methods\Entities\Assortment<extended>
     */
    public function testBuilder(): void
    {
        $this->assertNamedBuilderDebugSame(['entity', 'assortment']);
    }
}
