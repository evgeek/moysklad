<?php

namespace Evgeek\Tests\Feature\Api\Methods\Endpoints;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class NotificationTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Builders\Endpoints\Notification<extended>
     */
    public function testEndpointBuilder(): void
    {
        $this->assertNamedEndpointBuilder('notification');
    }
}
