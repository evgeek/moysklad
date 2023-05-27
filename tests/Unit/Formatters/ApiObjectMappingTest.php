<?php

namespace Evgeek\Tests\Unit\Formatters;

use Error;
use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\ApiObjects\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\ApiObjects\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\ApiObjects\Collections\UnknownCollection;
use Evgeek\Moysklad\ApiObjects\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Product;
use Evgeek\Moysklad\ApiObjects\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Entity;
use Evgeek\Moysklad\Formatters\ApiObjectMapping;
use Evgeek\Tests\Unit\Formatters\ExtendedObjects\ExtendedTestEmployee;
use Evgeek\Tests\Unit\Formatters\ExtendedObjects\ExtendedTestEmployeeCollection;
use Evgeek\Tests\Unit\Formatters\ExtendedObjects\ExtendedTestProduct;
use Evgeek\Tests\Unit\Formatters\ExtendedObjects\ExtendedTestProductCollection;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Evgeek\Moysklad\Formatters\ApiObjectMapping
 */
class ApiObjectMappingTest extends TestCase
{
    private ApiObjectMapping $mapping;

    protected function setUp(): void
    {
        $this->mapping = new ApiObjectMapping();
    }

    public function testSetSingleObjectWithCorrectClassWorks(): void
    {
        $this->assertSame(Product::class, $this->mapping->getObject(Entity::PRODUCT));

        $this->mapping->setObject(ExtendedTestProduct::class);

        $this->assertSame(ExtendedTestProduct::class, $this->mapping->getObject(Entity::PRODUCT));
    }

    public function testSetSingleObjectWithIncorrectClassWorks(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ExtendedTestProductCollection::class . ' is not a ' . AbstractConcreteObject::class);

        $this->mapping->setObject(ExtendedTestProductCollection::class);
    }

    public function testSetSingleObjectWithEmptyClassThrowsError(): void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Class "product" not found');

        $this->mapping->setObject(Entity::PRODUCT);
    }

    public function testSetMultipleObjectWithCorrectClassesWorks(): void
    {
        $this->assertSame(Product::class, $this->mapping->getObject(Entity::PRODUCT));
        $this->assertSame(Employee::class, $this->mapping->getObject(Entity::EMPLOYEE));

        $this->mapping->setObject([
            ExtendedTestProduct::class,
            ExtendedTestEmployee::class,
        ]);

        $this->assertSame(ExtendedTestProduct::class, $this->mapping->getObject(Entity::PRODUCT));
        $this->assertSame(ExtendedTestEmployee::class, $this->mapping->getObject(Entity::EMPLOYEE));
    }

    public function testGetNotRegisteredObjectReturnsUnknownObject(): void
    {
        $this->assertSame(UnknownObject::class, $this->mapping->getObject('wrong-object'));
    }

    public function testSetCollectionWithCorrectClassWorks(): void
    {
        $this->assertSame(ProductCollection::class, $this->mapping->getCollection(Entity::PRODUCT));

        $this->mapping->setCollection(ExtendedTestProductCollection::class);

        $this->assertSame(ExtendedTestProductCollection::class, $this->mapping->getCollection(Entity::PRODUCT));
    }

    public function testSetCollectionWithIncorrectClassWorks(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ExtendedTestProduct::class . ' is not a ' . AbstractConcreteCollection::class);

        $this->mapping->setCollection(ExtendedTestProduct::class);
    }

    public function testSetCollectionWithEmptyClassThrowsError(): void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Class "product" not found');

        $this->mapping->setCollection(Entity::PRODUCT);
    }

    public function testSetMultipleCollectionWithCorrectClassesWorks(): void
    {
        $this->assertSame(ProductCollection::class, $this->mapping->getCollection(Entity::PRODUCT));
        $this->assertSame(EmployeeCollection::class, $this->mapping->getCollection(Entity::EMPLOYEE));

        $this->mapping->setCollection([
            ExtendedTestProductCollection::class,
            ExtendedTestEmployeeCollection::class,
        ]);

        $this->assertSame(ExtendedTestProductCollection::class, $this->mapping->getCollection(Entity::PRODUCT));
        $this->assertSame(ExtendedTestEmployeeCollection::class, $this->mapping->getCollection(Entity::EMPLOYEE));
    }

    public function testGetNotRegisteredCollectionReturnsUnknownCollection(): void
    {
        $this->assertSame(UnknownCollection::class, $this->mapping->getCollection('wrong-collection'));
    }

    public function testRegisterMappingsFromConstructor(): void
    {
        $objectMapping = [
            Entity::PRODUCT => ExtendedTestProduct::class,
            Entity::EMPLOYEE => ExtendedTestEmployee::class,
        ];
        $collectionMapping = [
            Entity::PRODUCT => ExtendedTestProductCollection::class,
            Entity::EMPLOYEE => ExtendedTestEmployeeCollection::class,
        ];
        $mapping = new ApiObjectMapping($objectMapping, $collectionMapping);

        $this->assertSame(ExtendedTestProduct::class, $mapping->getObject(Entity::PRODUCT));
        $this->assertSame(ExtendedTestEmployee::class, $mapping->getObject(Entity::EMPLOYEE));
        $this->assertSame(ExtendedTestProductCollection::class, $mapping->getCollection(Entity::PRODUCT));
        $this->assertSame(ExtendedTestEmployeeCollection::class, $mapping->getCollection(Entity::EMPLOYEE));
    }

    public function testPurgeMappingsFromConstructor(): void
    {
        $mapping = new ApiObjectMapping([], []);

        $this->assertSame(UnknownObject::class, $mapping->getObject(Entity::PRODUCT));
        $this->assertSame(UnknownObject::class, $mapping->getObject(Entity::EMPLOYEE));
        $this->assertSame(UnknownCollection::class, $mapping->getCollection(Entity::PRODUCT));
        $this->assertSame(UnknownCollection::class, $mapping->getCollection(Entity::EMPLOYEE));
    }
}
