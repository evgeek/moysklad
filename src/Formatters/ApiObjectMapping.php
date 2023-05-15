<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\ApiObjects\Collections\AssortmentCollection;
use Evgeek\Moysklad\ApiObjects\Collections\CustomerorderCollection;
use Evgeek\Moysklad\ApiObjects\Collections\EmployeeCollection;
use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;
use Evgeek\Moysklad\ApiObjects\Collections\UnknownCollection;
use Evgeek\Moysklad\ApiObjects\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\ApiObjects\Objects\Documents\Customerorder;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Assortment;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Product;
use Evgeek\Moysklad\ApiObjects\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Document;
use Evgeek\Moysklad\Dictionaries\Entity;
use InvalidArgumentException;

class ApiObjectMapping
{
    protected const DEFAULT_MAPPING_OBJECTS = [
        Entity::PRODUCT => Product::class,
        Entity::EMPLOYEE => Employee::class,
        Entity::ASSORTMENT => Assortment::class,
        Document::CUSTOMERORDER => Customerorder::class,
    ];
    protected const DEFAULT_MAPPING_COLLECTIONS = [
        Entity::PRODUCT => ProductCollection::class,
        Entity::EMPLOYEE => EmployeeCollection::class,
        Entity::ASSORTMENT => AssortmentCollection::class,
        Document::CUSTOMERORDER => CustomerorderCollection::class,
    ];

    protected array $objects = self::DEFAULT_MAPPING_OBJECTS;
    protected array $collections = self::DEFAULT_MAPPING_COLLECTIONS;

    public function __construct(?array $objects = null, ?array $collections = null)
    {
        if (null !== $objects) {
            $this->objects = $objects;
        }
        if (null !== $collections) {
            $this->collections = $collections;
        }
    }

    /**
     * @param null|class-string<AbstractConcreteObject> $class
     */
    public function setObject(array|string $type, ?string $class = null): void
    {
        $this->set($this->objects, AbstractConcreteObject::class, $type, $class);
    }

    /**
     * @param null|class-string<AbstractConcreteCollection> $class
     */
    public function setCollection(array|string $type, ?string $class = null): void
    {
        $this->set($this->collections, AbstractConcreteCollection::class, $type, $class);
    }

    /**
     * @return class-string<AbstractConcreteObject>
     */
    public function getObject(string $type): string
    {
        return $this->get($this->objects, AbstractConcreteObject::class, $type) ?? UnknownObject::class;
    }

    /**
     * @return class-string<AbstractConcreteCollection>
     */
    public function getCollection(string $type): string
    {
        return $this->get($this->collections, AbstractConcreteCollection::class, $type) ?? UnknownCollection::class;
    }

    protected function set(array &$property, string $expectedClass, array|string $type, ?string $class): void
    {
        if (is_array($type)) {
            foreach ($type as $nestedType => $nestedClass) {
                $this->set($property, $expectedClass, $nestedType, $nestedClass);
            }

            return;
        }

        if (is_string($class)) {
            $this->validateClassIs($class, $expectedClass);
            $property[$type] = $class;

            return;
        }

        throw new InvalidArgumentException('Class cannot be empty with string type');
    }

    protected function validateClassIs(string $class, string $expectedClass): void
    {
        if (!is_a($class, $expectedClass, true)) {
            throw new InvalidArgumentException("$class is not a $expectedClass");
        }
    }

    private function get(array $property, string $expectedClass, string $type): ?string
    {
        if (!array_key_exists($type, $property)) {
            return null;
        }

        $class = $property[$type];
        $this->validateClassIs($class, $expectedClass);

        return $class;
    }
}
