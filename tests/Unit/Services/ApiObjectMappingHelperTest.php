<?php

namespace Evgeek\Tests\Unit\Services;

use Evgeek\Moysklad\ApiObjects\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\ApiObjects\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Product;
use Evgeek\Moysklad\Dictionaries\Entity;
use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\ApiObjectMappingHelper;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Services\ApiObjectMappingHelper */
class ApiObjectMappingHelperTest extends TestCase
{
    public const CONTENT = [
        'name' => 'test_name',
        'archived' => false,
        'amount' => 1.23,
    ];

    /** @dataProvider standardEntities */
    public function testResolvingRegisteredObject(string $type, string $expectedObjectClass): void
    {
        $object = ApiObjectMappingHelper::resolveObject($this->getMoySklad(), $type, self::CONTENT);

        $this->assertInstanceOf($expectedObjectClass, $object);
    }

    public function testResolvingUnregisteredObjectThrowsException(): void
    {
        $type = 'unregistered_type';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Object type '$type' has no mapped class");

        ApiObjectMappingHelper::resolveObject($this->getMoySklad(), $type);
    }

    /** @dataProvider standardEntities */
    public function testResolvingRegisteredCollection(string $type, string $expectedObjectClass, string $expectedCollectionClass): void
    {
        $object = ApiObjectMappingHelper::resolveCollection($this->getMoySklad(true), $type);

        $this->assertInstanceOf($expectedCollectionClass, $object);
    }

    public function testResolvingUnregisteredCollectionThrowsException(): void
    {
        $type = 'unregistered_type';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Collection type '$type' has no mapped class");

        ApiObjectMappingHelper::resolveCollection($this->getMoySklad(), $type);
    }

    public static function standardEntities(): array
    {
        return [
            [Entity::PRODUCT, Product::class, ProductCollection::class],
            [Entity::EMPLOYEE, Employee::class, EmployeeCollection::class],
        ];
    }

    private function getMoySklad(bool $withApiObjectFormatter = false): MoySklad
    {
        return $withApiObjectFormatter ?
            new MoySklad(['token'], new ApiObjectFormatter()) :
            new MoySklad(['token']);
    }
}
