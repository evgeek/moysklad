<?php

namespace Evgeek\Tests\Feature\Api\Builders\Methods\Entities;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class ProductTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Builders\Methods\Entities\Product<extended>
     */
    public function testBuilder(): void
    {
        $this->assertNamedBuilderDebugSame(['entity', 'product']);
    }
}
