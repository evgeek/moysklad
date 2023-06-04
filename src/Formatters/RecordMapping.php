<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\Api\Record\AbstractConcreteRecord;
use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerorderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\AssortmentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Customerorder;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Assortment;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Document;
use Evgeek\Moysklad\Dictionaries\Entity;
use InvalidArgumentException;

class RecordMapping
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
     * @param class-string<AbstractConcreteObject>|list<class-string<AbstractConcreteObject>> $class
     */
    public function setObject(array|string $class): static
    {
        $this->set($this->objects, AbstractConcreteObject::class, $class);

        return $this;
    }

    /**
     * @param class-string<AbstractConcreteCollection>|list<class-string<AbstractConcreteCollection>> $class
     */
    public function setCollection(array|string $class): static
    {
        $this->set($this->collections, AbstractConcreteCollection::class, $class);

        return $this;
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

    /** @param class-string<AbstractConcreteRecord>|list<class-string<AbstractConcreteRecord>> $class */
    protected function set(array &$property, string $expectedClass, array|string $class): void
    {
        if (is_array($class)) {
            foreach ($class as $nestedClass) {
                $this->set($property, $expectedClass, $nestedClass);
            }

            return;
        }

        $type = $class::TYPE;
        if (is_string($class)) {
            $this->validateClassIs($class, $expectedClass);
            $property[$type] = $class;

            return;
        }
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