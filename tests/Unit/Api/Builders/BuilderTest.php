<?php

namespace Evgeek\Tests\Unit\Api\Builders;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\Query;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Http\ApiClient;
use PHPUnit\Framework\TestCase;
use RuntimeException;

//Кажется, этот класс не нужен вообще - тестим только публичные методы, приватные в абстрактных классах - исключительно опосредованно

/** @covers \Evgeek\Moysklad\Api\Builders\Builder */
class BuilderTest extends TestCase
{
    private ApiClient $api;
    private Builder $builder;

    public function setUp(): void
    {
        parent::setUp();

        $this->api = $this->getMockBuilder(ApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->builder = new class ($this->api, [], []) extends Builder
        {
            public function wrongNamedBuilder()
            {
                return $this->resolveNamedBuilder('wrong-class');
            }

            public function wrongCommonBuilder()
            {
                return $this->resolveCommonBuilder('wrong-class', 'wrong-path');
            }

            protected function makeCurrentPath(): array
            {
                return [];
            }
        };
    }

    public function testWrongNamedBuilder(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Named builder resolving error');

        $this->builder->wrongNamedBuilder();
    }

    public function testApiSend(): void
    {
        $response = ['response' => 'ok'];
        $this->api->method('send')->willReturn($response);

        $this->assertSame($response, $this->builder->get());
    }

    public function testApiDebug(): void
    {
        $response = ['response' => 'debug'];
        $this->api->method('debug')->willReturn($response);

        $this->assertSame($response, $this->builder->debugGet());
    }
}
