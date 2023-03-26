<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Formatters\AbstractMultiDecoder;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

abstract class MultiDecoderTestCase extends TestCase
{
    protected const OBJECT_JSON_STRING = '{"param":"test_param","context":{"employee":{"meta":' .
        '{"href":"test_href_1","type":"employee"}}},"rows":[{"id":"id1","value":true},{"id":"id2","value":0},' .
        '{"id":"id3","value":null},{"id":"id4","value":123.45}]}';
    protected const ARRAYS_JSON_STRING = '[{"param":"value1","meta":"meta1"},{"param":"value2","meta":"meta2"}]';
    protected const EMPTY_JSON_STRING = '';

    protected const NULL_JSON_STRING = 'null';
    protected const FALSE_JSON_STRING = 'false';

    /** @var class-string<JsonFormatterInterface> */
    protected string $formatter = AbstractMultiDecoder::class;

    /** @dataProvider correctEncodeDataProvider */
    public function testEncodeCorrect(string $jsonString, mixed $formatted): void
    {
        $this->assertSame($formatted, (new $this->formatter())->encode($jsonString));
    }

    /** @dataProvider correctDecodeDataProvider */
    public function testDecodeCorrect(string $jsonString, mixed $formatted): void
    {
        $this->assertSame($jsonString, (new $this->formatter())->decode($formatted));
    }

    public static function correctDecodeDataProvider(): array
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

        return array_merge(static::correctEncodeDataProvider(), [
            ['', false],
            ['', null],
            [$json, $json],
            [$json, $array],
            [$json, $arrayOfObjects],
        ]);
    }

    /** @dataProvider invalidJsonTypesDataProvider */
    public function testEncodeUnexpectedDataType(string $jsonString): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed content is not valid json.');

        (new $this->formatter())->encode($jsonString);
    }

    public function testDecodeInvalidType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Can't convert content of");

        (new $this->formatter())->decode(NAN);
    }

    /** @dataProvider invalidJsonTypesDataProvider */
    public function testDecodeInvalidString(string $jsonString): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed content is not valid json.');

        (new $this->formatter())->decode($jsonString);
    }

    public static function invalidJsonTypesDataProvider(): array
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

    public static function correctEncodeDataProvider(): array
    {
        return [
            [self::OBJECT_JSON_STRING, static::getEncodedObject()],
            [self::ARRAYS_JSON_STRING, static::getEncodedArray()],
            ['', static::getEncodedEmpty()],
        ];
    }

    abstract protected static function getEncodedObject();

    abstract protected static function getEncodedArray();

    abstract protected static function getEncodedEmpty();
}
