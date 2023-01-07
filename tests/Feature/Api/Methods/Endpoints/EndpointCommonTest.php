<?php

namespace Evgeek\Tests\Feature\Api\Methods\Endpoints;

use Evgeek\Moysklad\Api\Methods\Endpoints\Endpoint;
use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use Evgeek\Tests\Feature\Api\ApiTestCase;

class EndpointCommonTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\EndpointCommon<extended>
     */
    public function testEndpointBuilder(): void
    {
        $endpoint = 'test_endpoint';
        $actual = $this->ms->endpoint($endpoint)->debug()->get();
        $expected = $this->makeExpectedDebug([$endpoint]);

        $this->assertSame($expected, $actual);
    }
}