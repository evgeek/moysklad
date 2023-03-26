<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\EmployeeCollection;
use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;
use Evgeek\Moysklad\ApiObjects\Collections\UnknownCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\Product;
use Evgeek\Moysklad\ApiObjects\Objects\UnknownObject;
use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\Formatters\ApiObjectMapping;
use Evgeek\Moysklad\MoySklad;

/**
 * @covers \Evgeek\Moysklad\Formatters\AbstractMultiDecoder
 * @covers \Evgeek\Moysklad\Formatters\ApiObjectFormatter
 */
class ApiObjectFormatterTest extends StdClassFormatTest
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
        }

        $resultFormatted = $this->castToArrayWithNested($result);

        $this->assertSame($formattedCasted, $resultFormatted);
    }

    public function testGetMappingReturnsPassedMapping(): void
    {
        $mapping = new ApiObjectMapping();
        $formatter = new ApiObjectFormatter($mapping);

        $this->assertSame($mapping, $formatter->getMapping());
    }

    /** @dataProvider arrayInputDataProvider */
    public function testEncodeToStdClassResultIsEqualToInput(array $input): void
    {
        $formatter = new ApiObjectFormatter();
        $formatter->setMoySklad(new MoySklad(['token']));
        $result = $formatter->encodeToStdClass($input);
        $formattedResult = $this->castToArrayWithNested($result);

        $this->assertSame($input, $formattedResult);
    }

    public static function arrayInputDataProvider(): array
    {
        return [
            [[]],
            [['test_item' => 'test_value']],
            [[['test_item' => 'test_value']]],
            [[['test_item' => ['key' => []]]]],
            [
                [
                    'meta' => [
                        'href' => 'https://online.moysklad.ru/api/remap/1.2/context/employee',
                        'type' => 'employee',
                    ],
                ],
            ],
            [
                [[
                    'meta' => [
                        'href' => 'https://online.moysklad.ru/api/remap/1.2/context/employee',
                        'type' => 'employee',
                    ],
                ]],
            ],
            [
                [
                    'meta' => [
                        'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/product',
                        'type' => 'product',
                    ],
                    'rows' => [],
                ],
            ],
        ];
    }

    public function testEncodeToStdClassWithComplicateInputReturnsExpectedTypes(): void
    {
        $input = [
            [
                'meta' => [
                    'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/product',
                    'type' => 'product',
                ],
                'context' => [
                    'employee' => [
                        'meta' => [
                            'href' => 'https://online.moysklad.ru/api/remap/1.2/context/employee',
                            'type' => 'employee',
                        ],
                    ],
                ],
                'rows' => [
                    [
                        'meta' => [
                            'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/product',
                            'type' => 'product',
                        ],
                        'id' => '25cf41f2-b068-11ed-0a80-0e9700500d7e',
                        'owner' => [
                            'meta' => [
                                'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/employee',
                                'type' => 'employee',
                            ],
                        ],
                        'fake_collection' => [
                            'meta' => [
                                'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/fake_entity',
                                'type' => 'fake_entity',
                            ],
                            'rows' => [
                                [
                                    'meta' => [
                                        'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/employee',
                                        'type' => 'employee',
                                    ],
                                    'rows' => [
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'meta' => [
                    'href' => 'https://online.moysklad.ru/api/remap/1.2/entity/fake_entity',
                    'type' => 'fake_entity',
                ],
                'id' => 'f731148b-a93d-11ed-0a80-0fba0011a6c6',
            ],
        ];

        $formatter = new ApiObjectFormatter();
        $formatter->setMoySklad(new MoySklad(['token']));
        $result = $formatter->encodeToStdClass($input);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);

        [$productCollection, $unknownObject] = $result;

        $this->assertInstanceOf(ProductCollection::class, $productCollection);
        $this->assertInstanceOf(UnknownObject::class, $unknownObject);
        $this->assertInstanceOf(Employee::class, $productCollection->context->employee);

        $product = $productCollection->rows[0];
        $this->assertInstanceOf(Product::class, $product);

        $owner = $product->owner;
        $this->assertInstanceOf(Employee::class, $owner);
        $this->assertSame([], $owner->toArray());

        $unknownCollection = $product->fake_collection;
        $this->assertInstanceOf(UnknownCollection::class, $unknownCollection);
        $this->assertInstanceOf(EmployeeCollection::class, $unknownCollection->rows[0]);
    }
}
