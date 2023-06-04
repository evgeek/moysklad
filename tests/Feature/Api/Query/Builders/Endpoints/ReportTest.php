<?php

namespace Evgeek\Tests\Feature\Api\Query\Builders\Endpoints;

use Evgeek\Tests\Feature\Api\Query\ApiTestCase;

class ReportTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Query\Segments\Endpoints\ReportSegment
     */
    public function testEndpointBuilder(): void
    {
        $this->assertNamedEndpointBuilder('report');
    }
}
