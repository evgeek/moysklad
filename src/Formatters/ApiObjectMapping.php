<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\ApiObjects\Objects\AbstractObject;
use Evgeek\Moysklad\ApiObjects\Objects\Entity\Product;
use InvalidArgumentException;

class ApiObjectMapping
{
    protected const DEFAULT_MAPPING = [
        'product' => Product::class
    ];

    private array $mapping = self::DEFAULT_MAPPING;

    public function __construct(?array $mapping = null)
    {
        if (!is_null($mapping)) {
            $this->mapping = $mapping;
        }
    }

    /**
     * @param class-string<AbstractObject>|null $class
     */
    public function set(array|string $type, ?string $class = null): static
    {
        if (is_array($type)) {
            foreach ($type as $nestedType => $nestedClass) {
                $this->set($nestedType, $nestedClass);
            }

            return $this;
        }

        if (is_string($class)) {
            $this->validateClassIsAbstractObject($class);

            $this->mapping[$type] = $class;

            return $this;
        }

        throw new InvalidArgumentException('Class cannot be empty with string type');
    }

    public function unset(string $type): static
    {
        unset($this->mapping[$type]);

        return $this;
    }

    public function toDefault(): static
    {
        $this->mapping = static::DEFAULT_MAPPING;

        return $this;
    }

    /**
     * @return class-string<AbstractObject>|null
     */
    public function get(string $type): ?string
    {
        if (!array_key_exists($type, $this->mapping)) {
            return null;
        }

        $class = $this->mapping[$type];
        $this->validateClassIsAbstractObject($class);

        return $class;
    }

    public function isset(string $key): bool
    {
        return array_key_exists($key, $this->mapping);
    }

    private function validateClassIsAbstractObject(string $class): void
    {
        if (!is_subclass_of($class, AbstractObject::class)) {
            throw new InvalidArgumentException("$class is not a " . AbstractObject::class);
        }
    }
}
