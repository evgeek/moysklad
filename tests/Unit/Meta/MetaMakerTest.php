<?php

namespace Evgeek\Tests\Unit\Meta;

use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Meta\MetaMaker */
class MetaMakerTest extends TestCase
{
    private const GUID = '25cf41f2-b068-11ed-0a80-0e9700500d7e';
    private MoySklad $ms;

    protected function setUp(): void
    {
        $this->ms = new MoySklad(['token'], new ArrayFormat());
    }

    /** @dataProvider creationDataProvider */
    public function testCreationMethod(string $method, array $params, string $expectedPath, string $expectedType): void
    {
        $expectedMeta = [
            'href' => Url::API . $expectedPath,
            'type' => $expectedType,
            'mediaType' => 'application/json',
        ];
        $this->assertSame($expectedMeta, $this->ms->meta()->{$method}(...$params));
    }

    public static function creationDataProvider(): array
    {
        return [
            ['create', [['segment1', 'segment2'], 'type'], '/segment1/segment2', 'type'],
            ['product', [self::GUID], '/entity/product/' . self::GUID, 'product'],
            ['employee', [self::GUID], '/entity/employee/' . self::GUID, 'employee'],
        ];
    }
}
