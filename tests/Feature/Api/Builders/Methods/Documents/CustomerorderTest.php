<?php

namespace Evgeek\Tests\Feature\Api\Builders\Methods\Documents;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class CustomerorderTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Builders\Methods\Documents\Customerorder<extended>
     */
    public function testBuilder(): void
    {
        $this->assertNamedBuilderDebugSame(['entity', 'customerorder']);
    }
}
