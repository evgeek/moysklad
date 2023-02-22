<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Formatters\StdClassFormat;
use stdClass;

/** @covers \Evgeek\Moysklad\Formatters\StdClassFormat<extended> */
class StdClassFormatTest extends MultiDecoderTestCase
{
    protected const FORMATTER = StdClassFormat::class;

    protected function getEncodedObject(): stdClass
    {
        return (object) [
            'param' => 'test_param',
            'context' => (object) [
                'employee' => (object) [
                    'meta' => (object) [
                        'href' => 'test_href_1',
                        'type' => 'employee',
                    ],
                ],
            ],
            'rows' => [
                (object) [
                    'id' => 'id1',
                    'value' => true,
                ],
                (object) [
                    'id' => 'id2',
                    'value' => 0,
                ],
                (object) [
                    'id' => 'id3',
                    'value' => null,
                ],
                (object) [
                    'id' => 'id4',
                    'value' => 123.45,
                ],
            ],
        ];
    }

    protected function getEncodedArray(): array
    {
        return [
            (object) ['param' => 'value1', 'meta' => 'meta1'],
            (object) ['param' => 'value2', 'meta' => 'meta2'],
        ];
    }

    protected function getEncodedEmpty(): stdClass
    {
        return new stdClass();
    }
}
