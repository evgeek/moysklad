<?php

namespace Evgeek\Tests\Feature\Api\Methods\Endpoints;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class AuditTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\Audit<extended>
     */
    public function testEndpointBuilder(): void
    {
        $this->assertNamedEndpointBuilder('audit');
    }
}
