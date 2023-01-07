<?php

namespace Evgeek\Tests\Feature\Api;

use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use PHPUnit\Framework\TestCase;

class ApiTestCase extends TestCase
{
    protected MoySklad $ms;
    protected const TOKEN = 'fake_token';

    protected function setUp(): void
    {
        parent::setUp();

        $this->ms = new MoySklad([static::TOKEN], Format::ARRAY);
    }

    protected function assertNamedEndpointBuilder(string $endpoint): void
    {
        $method = 'test_method';
        $actual = $this->ms->{$endpoint}()->method($method)->debug()->get();
        $expected = $this->makeExpectedDebug([$endpoint, $method]);

        $this->assertSame($expected, $actual);
    }

    protected function makeExpectedDebug(array $path, HttpMethod $method = HttpMethod::GET): array
    {
        $url = array_reduce($path, static fn (string $carry, string $item) => $carry .= '/' . $item, Url::API);

        return [
            'method' => $method->value,
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