<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Api\Record\AbstractRecord;
use Evgeek\Moysklad\Formatters\AbstractMultiDecoder;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\WithMoySkladInterface;
use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

abstract class MultiDecoderTestCase extends TestCase
{
    protected const OBJECT_JSON_STRING = '{"param":"test_param","meta":{"href":' .
        '"https:\/\/api.moysklad.ru\/api\/remap\/1.2\/endpoint\/segment","type":"product"},"context":' .
        '{"employee":{"meta":{"href":"https:\/\/api.moysklad.ru\/api\/remap\/1.2\/context\/employee","type":"employee"}}},' .
        '"rows":[{"id":"id1","value":true},{"id":"id2","value":0},{"id":"id3","value":null},{"id":"id4","value":123.45}]}';
    protected const ARRAYS_JSON_STRING = '[{"param":"value1","meta":"meta1"},{"param":"value2","meta":"meta2"}]';
    protected const EMPTY_JSON_STRING = '';

    protected const NULL_JSON_STRING = 'null';
    protected const FALSE_JSON_STRING = 'false';

    protected const SKIP_TEST = 'SKIP_TEST';

    /** @var class-string<JsonFormatterInterface> */
    protected const FORMATTER = AbstractMultiDecoder::class;
    protected JsonFormatterInterface $formatter;

    protected function setUp(): void
    {
        $formatterClass = static::FORMATTER;
        $this->formatter = new $formatterClass();
        if (is_a($this->formatter, WithMoySkladInterface::class)) {
            $this->formatter->setMoySklad(new MoySklad(['token']));
        }
    }

    /** @dataProvider correctEncodeDataProvider */
    public function testEncodeCorrect(string $jsonString, mixed $formatted): void
    {
        $this->assertSame($formatted, $this->formatter->encode($jsonString));
    }

    /** @dataProvider correctDecodeDataProvider */
    public function testDecodeCorrect(string $jsonString, mixed $formatted): void
    {
        $this->assertSame($jsonString, $this->formatter->decode($formatted));
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
        if ($jsonString === self::SKIP_TEST) {
            $this->markTestSkipped();
        }

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed content is not valid json.');

        $this->formatter->encode($jsonString);
    }

    public function testDecodeInvalidType(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Can't convert content of");

        $this->formatter->decode(NAN);
    }

    /** @dataProvider invalidJsonTypesDataProvider */
    public function testDecodeInvalidString(string $jsonString): void
    {
        if ($jsonString === self::SKIP_TEST) {
            $this->markTestSkipped();
        }

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Passed content is not valid json.');

        $this->formatter->decode($jsonString);
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

    protected function castToArrayWithNested(mixed $content): mixed
    {
        if (is_array($content)) {
            foreach ($content as $key => $value) {
                $content[$key] = $this->castToArrayWithNested($value);
            }

            return $content;
        }

        if (is_a($content, AbstractRecord::class)) {
            return $content->toArray();
        }

        if (is_object($content)) {
            return $this->castToArrayWithNested((array) $content);
        }

        return $content;
    }
}
