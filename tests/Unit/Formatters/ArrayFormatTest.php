<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Formatters\ArrayFormat;

/**
 * @covers \Evgeek\Moysklad\Formatters\AbstractMultiDecoder
 * @covers \Evgeek\Moysklad\Formatters\ArrayFormat
 */
class ArrayFormatTest extends MultiDecoderTestCase
{
    protected const FORMATTER = ArrayFormat::class;

    public static function getEncodedObject(): array
    {
        return [
            'param' => 'test_param',
            'meta' => [
                'href' => 'https://api.moysklad.ru/api/remap/1.2/endpoint/segment',
                'type' => 'product',
            ],
            'context' => [
                'employee' => [
                    'meta' => [
                        'href' => 'https://api.moysklad.ru/api/remap/1.2/context/employee',
                        'type' => 'employee',
                    ],
                ],
            ],
            'rows' => [
                [
                    'id' => 'id1',
                    'value' => true,
                ],
                [
                    'id' => 'id2',
                    'value' => 0,
                ],
                [
                    'id' => 'id3',
                    'value' => null,
                ],
                [
                    'id' => 'id4',
                    'value' => 123.45,
                ],
            ],
        ];
    }

    protected static function getEncodedArray(): array
    {
        return [
            ['param' => 'value1', 'meta' => 'meta1'],
            ['param' => 'value2', 'meta' => 'meta2'],
        ];
    }

    protected static function getEncodedEmpty(): array
    {
        return [];
    }
}
