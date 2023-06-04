<?php

namespace Evgeek\Tests\Feature\Api\Query\Builders\Methods\Entities;

use Evgeek\Tests\Feature\Api\Query\ApiTestCase;

class ProductTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProductSegment
     */
    public function testBuilder(): void
    {
        $this->assertNamedBuilderDebugSame(['entity', 'product']);
    }
}
