<?php

namespace Evgeek\Tests\Feature\Api\Builders\Endpoints;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class NotificationTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Endpoints\NotificationSegment<extended>
     */
    public function testEndpointBuilder(): void
    {
        $this->assertNamedEndpointBuilder('notification');
    }
}
