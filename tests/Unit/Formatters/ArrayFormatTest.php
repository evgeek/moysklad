<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Formatters\ArrayFormat;

/** @covers \Evgeek\Moysklad\Formatters\ArrayFormat<extended> */
class ArrayFormatTest extends MultiDecoderTestCase
{
    protected string $formatter = ArrayFormat::class;

    protected function getEncodedObject(): array
    {
        return [
            'param' => 'test_param',
            'context' => [
                'employee' => [
                    'meta' => [
                        'href' => 'test_href_1',
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

    protected function getEncodedArray(): array
    {
        return [
            ['param' => 'value1', 'meta' => 'meta1'],
            ['param' => 'value2', 'meta' => 'meta2'],
        ];
    }

    protected function getEncodedEmpty(): array
    {
        return [];
    }
}
