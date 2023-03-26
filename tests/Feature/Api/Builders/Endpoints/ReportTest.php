<?php

namespace Evgeek\Tests\Feature\Api\Builders\Endpoints;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class ReportTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Endpoints\ReportSegment
     */
    public function testEndpointBuilder(): void
    {
        $this->assertNamedEndpointBuilder('report');
    }
}
