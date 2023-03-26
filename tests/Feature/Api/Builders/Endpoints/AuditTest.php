<?php

namespace Evgeek\Tests\Feature\Api\Builders\Endpoints;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class AuditTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Endpoints\AuditSegment
     */
    public function testEndpointBuilder(): void
    {
        $this->assertNamedEndpointBuilder('audit');
    }
}
