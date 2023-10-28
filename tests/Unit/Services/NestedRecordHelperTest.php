<?php

namespace Evgeek\Tests\Unit\Services;

use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\NestedRecordHelper;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Services\NestedRecordHelper */
class NestedRecordHelperTest extends TestCase
{
    private const GUID = '25cf41f2-b068-11ed-0a80-0e9700500d7e';

    /** @dataProvider invalidParents */
    public function testGetParentPathWithInvalidMetaObjectThrows(ObjectInterface|string $invalidObject, string $expectedMessage): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedMessage);

        NestedRecordHelper::getParentPath(new MoySklad(['']), $invalidObject);
    }

    public static function invalidParents(): array
    {
        $ms = new MoySklad(['token']);

        $objectWithoutMetaHref = new CustomerOrder($ms, ['meta' => []]);
        $objectWithoutMeta = Product::make($ms);
        $objectWithoutMeta->meta = null;

        return [
            [$objectWithoutMetaHref, 'Parent object missing meta->href property'],
            [$objectWithoutMeta, 'Parent object missing meta->href property'],
            ['invalid-parent-type', 'String parent must be type of ' . AbstractConcreteObject::class],
        ];
    }

    /** @dataProvider validParents */
    public function testGetParentPathReturnsExpected(ObjectInterface|array|string $parent, array $expectedPath): void
    {
        $this->assertSame($expectedPath, NestedRecordHelper::getParentPath(new MoySklad(['']), $parent));
    }

    public static function validParents(): array
    {
        $ms = new MoySklad(['token']);

        $concreteObject = new Product($ms);
        $concreteObjectWithId = CustomerOrder::make($ms, ['id' => self::GUID]);
        $nestedObject = $ms->record()->object()->namedfilter($concreteObject, ['id' => self::GUID]);
        $unknownObject = UnknownObject::make($ms, ['test', 'path'], 'type', ['id' => self::GUID]);

        return [
            [['endpoint', 'segment'], ['endpoint', 'segment']],
            [$concreteObject, ['entity', 'product']],
            [$concreteObjectWithId, ['entity', 'customerorder', self::GUID]],
            [$nestedObject, ['entity', 'product', 'namedfilter', self::GUID]],
            [$unknownObject, ['test', 'path', self::GUID]],
            ['product', ['entity', 'product']],
            [Product::class, ['entity', 'product']],
        ];
    }

    /** @dataProvider paths */
    public function testClearParentPathReturnsExpected(array $parentPath, array $nestedPath, array $expectedResult): void
    {
        $this->assertSame($expectedResult, NestedRecordHelper::clearParentPath($parentPath, $nestedPath));
    }

    public static function paths(): array
    {
        return [
            [['endpoint', 'segment', 'nested'], ['nested'], ['endpoint', 'segment']],
            [['endpoint', 'segment', 'nested', self::GUID], ['nested'], ['endpoint', 'segment']],
            [['endpoint', 'segment', self::GUID, 'nested'], ['nested'], ['endpoint', 'segment', self::GUID]],
            [['endpoint', 'segment', self::GUID, 'nested', self::GUID], ['nested'], ['endpoint', 'segment', self::GUID]],
            [['endpoint', 'nested1', 'nested2'], ['nested1', 'nested2'], ['endpoint']],
            [['endpoint', 'nested1', 'nested2', self::GUID], ['nested1', 'nested2'], ['endpoint']],
            [['endpoint', self::GUID, 'nested1', 'nested2'], ['nested1', 'nested2'], ['endpoint', self::GUID]],
            [['endpoint', self::GUID, 'nested1', 'nested2', self::GUID], ['nested1', 'nested2'], ['endpoint', self::GUID]],
        ];
    }
}
