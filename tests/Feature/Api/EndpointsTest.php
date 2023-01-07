<?php

namespace Evgeek\Tests\Feature\Api;

use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use Evgeek\Tests\Feature\FeatureTestCase;

class EndpointsTest extends FeatureTestCase
{
    protected MoySklad $ms;
    protected const TOKEN = 'fake_token';

    protected function setUp(): void
    {
        parent::setUp();

        $this->ms = new MoySklad([static::TOKEN], Format::ARRAY);
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\EndpointCommon
     */
    public function testEndpoint(): void
    {
        $endpoint = 'test_endpoint';
        $actual = $this->ms->endpoint($endpoint)->debug()->get();
        $expected = $this->makeExpectedDebug($endpoint);

        $this->assertSame($expected, $actual);
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\Entity
     */
    public function testEntity(): void
    {
        $this->assertNamedEndpointSame('entity');
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\Report
     */
    public function testReport(): void
    {
        $this->assertNamedEndpointSame('report');
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\Audit
     */
    public function testAudit(): void
    {
        $this->assertNamedEndpointSame('audit');
    }

    /**
     * @covers \Evgeek\Moysklad\Api\Methods\Endpoints\Notification
     */
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