<?php

namespace Evgeek\Tests\Feature\Api\Query\Builders\Methods\Entities;

use Evgeek\Tests\Feature\Api\Query\ApiTestCase;

class AssortmentTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\AssortmentSegment
     */
    public function testBuilder(): void
    {
        $this->assertNamedBuilderDebugSame(['entity', 'assortment']);
    }
}
