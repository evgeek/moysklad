<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Formatters\AbstractMultiDecoder;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

abstract class MultiDecoderTestCase extends TestCase
{
    /** @var class-string<JsonFormatterInterface>|JsonFormatterInterface */
    protected const FORMATTER = AbstractMultiDecoder::class;

    protected const OBJECT_JSON_STRING = '{"param":"test_param","context":{"employee":{"meta":' .
        '{"href":"test_href_1","type":"employee"}}},"rows":[{"id":"id1","value":true},{"id":"id2","value":0},' .
        '{"id":"id3","value":null},{"id":"id4","value":123.45}]}';
    protected const ARRAYS_JSON_STRING = '[{"param":"value1","meta":"meta1"},{"param":"value2","meta":"meta2"}]';
    protected const EMPTY_JSON_STRING = '';

    protected const NULL_JSON_STRING = 'null';
    protected const FALSE_JSON_STRING = 'false';

    /** @dataProvider correctEncodeDataProvider */
    public function testEncodeCorrect(string $jsonString, mixed $formatted): void
    {
        $this->assertSame($formatted, (static::FORMATTER)::encode($jsonString));
    }

    /** @dataProvider correctDecodeDataProvider */
    public function testDecodeCorrect(string $jsonString, mixed $formatted): void
    {
        $this->assertSame($jsonString, (static::FORMATTER)::decode($formatted));
    }

    /** @dataProvider invalidJsonTypesDataProvider */
    public function testEncodeUnexpectedDataType(string $jsonString): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed content is not valid json.');

        (static::FORMATTER)::encode($jsonString);
    }

    public function testDecodeInvalidType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Can't convert content of");

        (static::FORMATTER)::decode(NAN);
    }

    /** @dataProvider invalidJsonTypesDataProvider */
    public function testDecodeInvalidString(string $jsonString): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed content is not valid json.');

        (static::FORMATTER)::decode($jsonString);
    }

    abstract protected function getEncodedObject();

    abstract protected function getEncodedArray();

    abstract protected function getEncodedEmpty();

    protected function correctEncodeDataProvider(): array
    {
        return [
            [self::OBJECT_JSON_STRING, $this->getEncodedObject()],
            [self::ARRAYS_JSON_STRING, $this->getEncodedArray()],
            ['', $this->getEncodedEmpty()],
        ];
    }

    protected function correctDecodeDataProvider(): array
    {
        $json = '[{"param1":"value1","param2":false},{"param1":2.34,"param2":null}]';
        $array = [
            ['param1' => 'value1', 'param2' => false],
            ['param1' => 2.34, 'param2' => null],
        ];
        $object1 = new stdClass();
        $object1->param1 = 'value1';
        $object1->param2 = false;
        $object2 = new stdClass();
        $object2->param1 = 2.34;
        $object2->param2 = null;
        $arrayOfObjects = [$object1, $object2];

        return array_merge($this->correctEncodeDataProvider(), [
            ['', false],
            ['', null],
            [$json, $json],
            [$json, $array],
            [$json, $arrayOfObjects],
        ]);
    }

    private function invalidJsonTypesDataProvider(): array
    {
        return [
            ['invalid-json-encode'],
            ['123.45'],
            ['77'],
            ['true'],
            ['false'],
            ['null'],
        ];
    }
}
