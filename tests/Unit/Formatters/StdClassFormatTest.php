<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Formatters\StdClassFormat;
use stdClass;

/** @covers \Evgeek\Moysklad\Formatters\StdClassFormat<extended> */
class StdClassFormatTest extends MultiDecoderTestCase
{
    protected string $formatter = StdClassFormat::class;

    /** @dataProvider correctEncodeDataProvider */
    public function testEncodeCorrect(string $jsonString, mixed $formatted): void
    {
        $formattedCasted = $this->castToArrayWithNested($formatted);
        $encodedCasted = $this->castToArrayWithNested((new $this->formatter())->encode($jsonString));

        $this->assertSame($formattedCasted, $encodedCasted);
    }

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

    protected function castToArrayWithNested(stdClass|array $array): array
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = $this->castToArrayWithNested($value);
                }
                if (is_object($value)) {
                    $array[$key] = $this->castToArrayWithNested((array) $value);
                }
            }
        }
        if (is_object($array)) {
            return $this->castToArrayWithNested((array) $array);
        }

        return $array;
    }
}
