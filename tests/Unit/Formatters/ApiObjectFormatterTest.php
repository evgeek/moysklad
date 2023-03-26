<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Employee;
use Evgeek\Moysklad\Formatters\ApiObjectFormatter;

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

            $resultFormatted = $result->toArray();
        } else {
            $resultFormatted = $this->castToArrayWithNested($result);
        }

        $this->assertSame($formattedCasted, $resultFormatted);
    }
}
