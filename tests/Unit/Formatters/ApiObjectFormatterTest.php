<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Employee;
use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use stdClass;

/**
 * @covers \Evgeek\Moysklad\Formatters\AbstractMultiDecoder
 * @covers \Evgeek\Moysklad\Formatters\ApiObjectFormatter
 */
class ApiObjectFormatterTest extends MultiDecoderTestCase
{
    protected const FORMATTER = ApiObjectFormatter::class;

    /** @dataProvider correctEncodeDataProvider */
    public function testEncodeCorrect(string $jsonString, mixed $formatted): void
    {
        $formattedCasted = $this->castToArrayWithNested($formatted);
        $result = $this->formatter->encode($jsonString);

        if (is_a($result, AbstractApiObject::class)) {
            $this->assertInstanceOf(ProductCollection::class, $result);
            $this->assertInstanceOf(Employee::class, $result->context->employee);

            $resultFormatted = $result->toArray();
        } else {
            $resultFormatted = $this->castToArrayWithNested($result);
        }

        $this->assertSame($formattedCasted, $resultFormatted);
    }

    protected static function getEncodedObject(): stdClass
    {
        return (object) [
            'param' => 'test_param',
            'meta' => (object) [
                'href' => 'https://online.moysklad.ru/api/remap/1.2/endpoint/segment',
                'type' => 'product',
            ],
            'context' => (object) [
                'employee' => (object) [
                    'meta' => (object) [
                        'href' => 'https://online.moysklad.ru/api/remap/1.2/context/employee',
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

    protected static function getEncodedArray(): array
    {
        return [
            (object) ['param' => 'value1', 'meta' => 'meta1'],
            (object) ['param' => 'value2', 'meta' => 'meta2'],
        ];
    }

    protected static function getEncodedEmpty(): stdClass
    {
        return new stdClass();
    }
}
