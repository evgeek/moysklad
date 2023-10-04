<?php

namespace Evgeek\Tests\Unit\Formatters;

use Error;
use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Moysklad\Formatters\RecordMapping;
use Evgeek\Tests\Unit\Formatters\ExtendedObjects\ExtendedTestEmployee;
use Evgeek\Tests\Unit\Formatters\ExtendedObjects\ExtendedTestEmployeeCollection;
use Evgeek\Tests\Unit\Formatters\ExtendedObjects\ExtendedTestProduct;
use Evgeek\Tests\Unit\Formatters\ExtendedObjects\ExtendedTestProductCollection;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Evgeek\Moysklad\Formatters\RecordMapping
 */
class RecordMappingTest extends TestCase
{
    private RecordMapping $mapping;

    protected function setUp(): void
    {
        $this->mapping = new RecordMapping();
    }

    public function testSetSingleObjectWithCorrectClassWorks(): void
    {
        $this->assertSame(Product::class, $this->mapping->getObject(Type::PRODUCT));

        $this->mapping->setObject(ExtendedTestProduct::class);

        $this->assertSame(ExtendedTestProduct::class, $this->mapping->getObject(Type::PRODUCT));
    }

    public function testSetSingleObjectWithIncorrectClassWorks(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ExtendedTestProductCollection::class . ' is not in [' .
            AbstractConcreteObject::class . ', ' . AbstractNestedObject::class . ']');

        $this->mapping->setObject(ExtendedTestProductCollection::class);
    }

    public function testSetSingleObjectWithEmptyClassThrowsError(): void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Class "product" not found');

        $this->mapping->setObject(Type::PRODUCT);
    }

    public function testSetMultipleObjectWithCorrectClassesWorks(): void
    {
        $this->assertSame(Product::class, $this->mapping->getObject(Type::PRODUCT));
        $this->assertSame(Employee::class, $this->mapping->getObject(Type::EMPLOYEE));

        $this->mapping->setObject([
            ExtendedTestProduct::class,
            ExtendedTestEmployee::class,
        ]);

        $this->assertSame(ExtendedTestProduct::class, $this->mapping->getObject(Type::PRODUCT));
        $this->assertSame(ExtendedTestEmployee::class, $this->mapping->getObject(Type::EMPLOYEE));
    }

    public function testGetNotRegisteredObjectReturnsUnknownObject(): void
    {
        $this->assertSame(UnknownObject::class, $this->mapping->getObject('wrong-object'));
    }

    public function testSetCollectionWithCorrectClassWorks(): void
    {
        $this->assertSame(ProductCollection::class, $this->mapping->getCollection(Type::PRODUCT));

        $this->mapping->setCollection(ExtendedTestProductCollection::class);

        $this->assertSame(ExtendedTestProductCollection::class, $this->mapping->getCollection(Type::PRODUCT));
    }

    public function testSetCollectionWithIncorrectClassWorks(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ExtendedTestProduct::class . ' is not in [' .
            AbstractConcreteCollection::class . ', ' . AbstractNestedCollection::class . ']');

        $this->mapping->setCollection(ExtendedTestProduct::class);
    }

    public function testSetCollectionWithEmptyClassThrowsError(): void
    {
        $this->expectException(Error::class);
        $this->expectExceptionMessage('Class "product" not found');

        $this->mapping->setCollection(Type::PRODUCT);
    }

    public function testSetMultipleCollectionWithCorrectClassesWorks(): void
    {
        $this->assertSame(ProductCollection::class, $this->mapping->getCollection(Type::PRODUCT));
        $this->assertSame(EmployeeCollection::class, $this->mapping->getCollection(Type::EMPLOYEE));

        $this->mapping->setCollection([
            ExtendedTestProductCollection::class,
            ExtendedTestEmployeeCollection::class,
        ]);

        $this->assertSame(ExtendedTestProductCollection::class, $this->mapping->getCollection(Type::PRODUCT));
        $this->assertSame(ExtendedTestEmployeeCollection::class, $this->mapping->getCollection(Type::EMPLOYEE));
    }

    public function testGetNotRegisteredCollectionReturnsUnknownCollection(): void
    {
        $this->assertSame(UnknownCollection::class, $this->mapping->getCollection('wrong-collection'));
    }

    public function testRegisterMappingsFromConstructor(): void
    {
        $objectMapping = [
            Type::PRODUCT => ExtendedTestProduct::class,
            Type::EMPLOYEE => ExtendedTestEmployee::class,
        ];
        $collectionMapping = [
            Type::PRODUCT => ExtendedTestProductCollection::class,
            Type::EMPLOYEE => ExtendedTestEmployeeCollection::class,
        ];
        $mapping = new RecordMapping($objectMapping, $collectionMapping);

        $this->assertSame(ExtendedTestProduct::class, $mapping->getObject(Type::PRODUCT));
        $this->assertSame(ExtendedTestEmployee::class, $mapping->getObject(Type::EMPLOYEE));
        $this->assertSame(ExtendedTestProductCollection::class, $mapping->getCollection(Type::PRODUCT));
        $this->assertSame(ExtendedTestEmployeeCollection::class, $mapping->getCollection(Type::EMPLOYEE));
    }

    public function testPurgeMappingsFromConstructor(): void
    {
        $mapping = new RecordMapping([], []);

        $this->assertSame(UnknownObject::class, $mapping->getObject(Type::PRODUCT));
        $this->assertSame(UnknownObject::class, $mapping->getObject(Type::EMPLOYEE));
        $this->assertSame(UnknownCollection::class, $mapping->getCollection(Type::PRODUCT));
        $this->assertSame(UnknownCollection::class, $mapping->getCollection(Type::EMPLOYEE));
    }
}
