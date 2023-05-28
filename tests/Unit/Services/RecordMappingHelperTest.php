<?php

namespace Evgeek\Tests\Unit\Services;

use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Dictionaries\Entity;
use Evgeek\Moysklad\Formatters\RecordFormatter;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\RecordMappingHelper;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Services\RecordMappingHelper */
class RecordMappingHelperTest extends TestCase
{
    public const CONTENT = [
        'name' => 'test_name',
        'archived' => false,
        'amount' => 1.23,
    ];

    /** @dataProvider standardEntities */
    public function testResolvingRegisteredObject(string $type, string $expectedObjectClass): void
    {
        $object = RecordMappingHelper::resolveObject($this->getMoySklad(), $type, self::CONTENT);

        $this->assertInstanceOf($expectedObjectClass, $object);
    }

    public function testResolvingUnregisteredObjectThrowsException(): void
    {
        $type = 'unregistered_type';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Object type '$type' has no mapped class");

        RecordMappingHelper::resolveObject($this->getMoySklad(), $type);
    }

    /** @dataProvider standardEntities */
    public function testResolvingRegisteredCollection(string $type, string $expectedObjectClass, string $expectedCollectionClass): void
    {
        $object = RecordMappingHelper::resolveCollection($this->getMoySklad(true), $type);

        $this->assertInstanceOf($expectedCollectionClass, $object);
    }

    public function testResolvingUnregisteredCollectionThrowsException(): void
    {
        $type = 'unregistered_type';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Collection type '$type' has no mapped class");

        RecordMappingHelper::resolveCollection($this->getMoySklad(), $type);
    }

    public static function standardEntities(): array
    {
        return [
            [Entity::PRODUCT, Product::class, ProductCollection::class],
            [Entity::EMPLOYEE, Employee::class, EmployeeCollection::class],
        ];
    }

    private function getMoySklad(bool $withRecordFormatter = false): MoySklad
    {
        return $withRecordFormatter ?
            new MoySklad(['token'], new RecordFormatter()) :
            new MoySklad(['token']);
    }
}
