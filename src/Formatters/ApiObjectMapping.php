<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\ApiObjects\Collections\AbstractCollection;
use Evgeek\Moysklad\ApiObjects\Collections\EmployeeCollection;
use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;
use Evgeek\Moysklad\ApiObjects\Objects\AbstractObject;
use Evgeek\Moysklad\ApiObjects\Objects\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\Product;
use InvalidArgumentException;

class ApiObjectMapping
{
    protected const DEFAULT_MAPPING_ENTITIES = [
        'product' => Product::class,
        'employee' => Employee::class,
    ];
    protected const DEFAULT_MAPPING_CONTAINERS = [
        'product' => ProductCollection::class,
        'employee' => EmployeeCollection::class,
    ];

    protected array $objects = self::DEFAULT_MAPPING_ENTITIES;
    protected array $containers = self::DEFAULT_MAPPING_CONTAINERS;

    public function __construct(?array $objects = null, ?array $containers = null)
    {
        if (null !== $objects) {
            $this->objects = $objects;
        }
        if (null !== $containers) {
            $this->containers = $containers;
        }
    }

    /**
     * @param null|class-string<AbstractObject> $class
     */
    public function setObject(array|string $type, ?string $class = null): void
    {
        $this->set($this->objects, AbstractObject::class, $type, $class);
    }

    /**
     * @param null|class-string<AbstractCollection> $class
     */
    public function setContainer(array|string $type, ?string $class = null): void
    {
        $this->set($this->containers, AbstractCollection::class, $type, $class);
    }

    /**
     * @return null|class-string<AbstractObject>
     */
    public function getObject(string $type): ?string
    {
        return $this->get($this->objects, AbstractObject::class, $type);
    }

    /**
     * @return null|class-string<AbstractCollection>
     */
    public function getContainer(string $type): ?string
    {
        return $this->get($this->containers, AbstractCollection::class, $type);
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
        if (!is_subclass_of($class, $expectedClass)) {
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
