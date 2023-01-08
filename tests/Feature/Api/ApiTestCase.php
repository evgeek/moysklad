<?php

namespace Evgeek\Tests\Feature\Api;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\Methods\Method;
use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use PHPUnit\Framework\TestCase;

class ApiTestCase extends TestCase
{
    protected const TOKEN = 'fake_token';
    protected MoySklad $ms;

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

    protected function assertNamedBuilderDebugSame(array $path): void
    {
        /** @var Method $ms */
        $ms = array_reduce($path, static fn(MoySklad|Builder $builder, string $method) => $builder->{$method}(), $this->ms);
        $actual = $ms->debug()->get();
        $expected = $this->makeExpectedDebug($path);

        $this->assertSame($expected, $actual);
    }

    protected function assertCommonBuilderDebugSame(string $endpoint, string $method, array $path = []): void
    {
        /** @var Method $ms */
        $ms = array_reduce(
            $path,
            static fn(Builder $builder, string $method) => $builder->{$method}(),
            $this->ms->endpoint($endpoint)->method($method)
        );
        $actual = $ms->debug()->get();
        $expected = $this->makeExpectedDebug([$endpoint, $method, ...$path]);

        $this->assertSame($expected, $actual);
    }

    protected function makeExpectedDebug(array $path, HttpMethod $method = HttpMethod::GET, ?array $body = null): array
    {
        $url = array_reduce($path, static fn (string $carry, string $item) => $carry .= '/' . $item, Url::API);

        return [
            'method' => $method->value,
            'url' => urldecode($url),
            'url_encoded' => $url,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . static::TOKEN,
            ],
            'body' => $body ?? '',
        ];
    }
}
