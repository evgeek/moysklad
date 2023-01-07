<?php

namespace Evgeek\Tests\Feature\Api\Methods\Endpoints;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class ReportTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\Report<extended>
     */
    public function testEndpointBuilder(): void
    {
        $this->assertNamedEndpointBuilder('report');
    }
}
