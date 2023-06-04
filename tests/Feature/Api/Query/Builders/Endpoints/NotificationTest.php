<?php

namespace Evgeek\Tests\Feature\Api\Query\Builders\Endpoints;

use Evgeek\Tests\Feature\Api\Query\ApiTestCase;

class NotificationTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Query\Segments\Endpoints\NotificationSegment
     */
    public function testEndpointBuilder(): void
    {
        $this->assertNamedEndpointBuilder('notification');
    }
}
