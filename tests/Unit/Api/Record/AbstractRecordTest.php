<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record;

use Evgeek\Moysklad\Api\Record\AbstractConcreteRecord;
use Evgeek\Moysklad\Api\Record\AbstractUnknownRecord;
use Evgeek\Moysklad\Api\Record\Collections\Traits\FillMetaCollectionTrait;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\RecordFormatter;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Tools\Meta;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Record\AbstractConcreteRecord
 * @covers \Evgeek\Moysklad\Api\Record\AbstractRecord
 * @covers \Evgeek\Moysklad\Api\Record\AbstractUnknownRecord
 */
class AbstractRecordTest extends TestCase
{
    private const CONTENT = [
        'key' => 'value',
        'array_key' => ['inner_key' => 'inner_value'],
    ];

    public function testEmptyPathThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('path and type cannot be empty');

        $this->getUnknownObject([], 'type');
    }

    public function testEmptyTypeThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('path and type cannot be empty');

        $this->getUnknownObject(['path'], '');
    }

    public function testMetaFilledFromConstants(): void
    {
        $object = $this->getConcreteObject();

        $this->assertSame('unknown-type', $object->meta->type);
        $this->assertStringEndsWith('endpoint/segment', $object->meta->href);
    }

    public function testGetExistingProperty(): void
    {
        $key = 'test_key';
        $value = 'test_value';

        $object = $this->getConcreteObject([$key => $value]);

        $this->assertSame($value, $object->{$key});
    }

    public function testGetNotExistingProperty(): void
    {
        $object = $this->getConcreteObject();

        $this->assertNull($object->unknown_key);
    }

    public function testSetMethodFillProperty(): void
    {
        $key = 'test_key';
        $value = 'test_value';

        $object = $this->getConcreteObject();

        $this->assertNull($object->{$value});

        $object->{$key} = $value;

        $this->assertSame($value, $object->{$key});
    }

    public function testIssetAndUnsetWorks(): void
    {
        $key = 'test_key';
        $value = 'test_value';

        $object = $this->getConcreteObject([$key => $value]);

        $this->assertTrue(isset($object->{$key}));

        unset($object->{$key});

        $this->assertFalse(isset($object->{$key}));
    }

    public function testToArray(): void
    {
        $object = $this->getConcreteObjectWithExpectedContent();
        $expected = $this->getExpectedObjectContentAsArray();

        $this->assertSame($expected, $object->toArray());
    }

    public function testToString(): void
    {
        $object = $this->getConcreteObjectWithExpectedContent();
        $expected = json_encode($this->getExpectedObjectContentAsArray(), JSON_THROW_ON_ERROR);

        $this->assertSame($expected, $object->toString());
    }

    public function testToStdClass(): void
    {
        $object = $this->getConcreteObjectWithExpectedContent();
        $expected = $this->getExpectedObjectContentAsArray();

        $result = $object->toStdClass();
        $resultAsString = json_encode($result, JSON_THROW_ON_ERROR);
        $resultAsArray = json_decode($resultAsString, true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame($expected, $resultAsArray);
    }

    private function getConcreteObjectWithExpectedContent(): AbstractConcreteRecord
    {
        $ms = new MoySklad(['token'], new RecordFormatter());

        return $this->getConcreteObject(self::CONTENT, $ms);
    }

    private function getExpectedObjectContentAsArray(): array
    {
        $expected = self::CONTENT;
        $expected['meta'] = Meta::create(['endpoint', 'segment'], 'unknown-type', new ArrayFormat());

        return $expected;
    }

    private function getConcreteObject(array $content = [], MoySklad $ms = new MoySklad(['token'])): AbstractConcreteRecord
    {
        return new class($ms, $content) extends AbstractConcreteRecord {
            use FillMetaCollectionTrait;

            public const PATH = ['endpoint', 'segment'];
            public const TYPE = 'unknown-type';
        };
    }

    private function getUnknownObject(array $path, string $type): void
    {
        new class(new MoySklad(['token']), $path, $type, []) extends AbstractUnknownRecord {
            use FillMetaCollectionTrait;
        };
    }
}
