<?php

namespace Evgeek\Tests\Feature\Api\Methods\Endpoints;

use Evgeek\Moysklad\Api\Methods\Endpoints\Endpoint;
use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
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