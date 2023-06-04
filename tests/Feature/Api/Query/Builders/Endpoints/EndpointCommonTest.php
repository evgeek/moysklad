<?php

namespace Evgeek\Tests\Feature\Api\Query\Builders\Endpoints;

use Evgeek\Tests\Feature\Api\Query\ApiTestCase;

class EndpointCommonTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Query\Segments\Endpoints\EndpointSegmentCommon
     */
    public function testEndpointBuilder(): void
    {
        $endpoint = 'test_endpoint';
        $actual = $this->query->endpoint($endpoint)->debug()->get();
        $expected = $this->makeExpectedDebug([$endpoint]);

        $this->assertSame($expected, $actual);
    }
}
