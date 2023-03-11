<?php

namespace Evgeek\Tests\Feature\Api\Builders\Endpoints;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class EndpointCommonTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Endpoints\EndpointSegmentCommon<extended>
     */
    public function testEndpointBuilder(): void
    {
        $endpoint = 'test_endpoint';
        $actual = $this->query->endpoint($endpoint)->debug()->get();
        $expected = $this->makeExpectedDebug([$endpoint]);

        $this->assertSame($expected, $actual);
    }
}
