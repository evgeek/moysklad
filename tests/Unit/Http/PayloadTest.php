<?php

namespace Evgeek\Tests\Unit\Http;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Http\Payload;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Http\Payload */
class PayloadTest extends TestCase
{
    public function testPayloadCorrectlySavedPassedParams(): void
    {
        $method = HttpMethod::GET;
        $path = [
            'entity',
            'product',
        ];
        $params = [
            'limit' => 1,
            'filter' => 'name!=orange;amount>=10',
        ];
        $body = ['not_empty_body'];

        $payload = new Payload($method, $path, $params, $body);

        $this->assertSame($method, $payload->method);
        $this->assertSame($path, $payload->path);
        $this->assertSame($params, $payload->params);
        $this->assertSame($body, $payload->body);
    }
}
