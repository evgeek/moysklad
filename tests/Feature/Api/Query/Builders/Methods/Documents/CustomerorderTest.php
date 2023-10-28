<?php

namespace Evgeek\Tests\Feature\Api\Query\Builders\Methods\Documents;

use Evgeek\Tests\Feature\Api\Query\ApiTestCase;

class CustomerorderTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CustomerOrderSegment
     */
    public function testBuilder(): void
    {
        $this->assertNamedBuilderDebugSame(['entity', 'customerorder']);
    }
}
