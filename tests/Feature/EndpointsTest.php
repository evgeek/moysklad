<?php

namespace Evgeek\Tests\Feature;

use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;

class EndpointsTest extends FeatureTestCase
{
    protected MoySklad $ms;
    protected const TOKEN = 'fake_token';

    protected function setUp(): void
    {
        parent::setUp();

        $this->ms = new MoySklad([static::TOKEN], Format::ARRAY);
    }
    public function testEndpoint(): void
    {
        $endpoint = 'test_endpoint';
        $actual = $this->ms->endpoint($endpoint)->debug()->get();
        $expected = $this->makeExpectedDebug($endpoint);

        $this->assertSame($expected, $actual);
    }

    public function testEntity(): void
    {
        $this->assertNamedEndpointSame('entity');
    }

    public function testReport(): void
    {
        $this->assertNamedEndpointSame('report');
    }

    public function testAudit(): void
    {
        $this->assertNamedEndpointSame('audit');
    }

    public function testNotification(): void
    {
        $this->assertNamedEndpointSame('notification');
    }

    private function assertNamedEndpointSame(string $endpoint): void
    {
        $method = 'test_method';
        $actual = $this->ms->{$endpoint}()->method($method)->debug()->get();
        $expected = $this->makeExpectedDebug($endpoint, $method);

        $this->assertSame($expected, $actual);
    }

    private function makeExpectedDebug(...$path): array
    {
        $url = array_reduce($path, static fn (string $carry, string $item) => $carry .= '/' . $item, Url::API);

        return [
            'method' => HttpMethod::GET->value,
            'url' => $url,
            'url_encoded' => $url,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . static::TOKEN,
            ],
            'body' => '',
        ];
    }
}