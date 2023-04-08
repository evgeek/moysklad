<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\Enums\HttpMethod;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Objects\Traits\CrudObjectTrait
 */
class CrudObjectTraitTest extends ObjectTraitCase
{
    public function testGetMethodCallsSendWithExpectedParams(): void
    {
        $object = $this->getTestObject(['id' => self::GUID]);
        $this->expectsSendCalledWith(HttpMethod::GET, [...self::PATH, self::GUID], [], $object);

        $object->get();
    }

    public function testGetMethodWithoutIdThrowsException(): void
    {
        $object = $this->getTestObject([]);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot load object without id');

        $object->get();
    }

    public function testCreateMethodCallsSendWithExpectedParams(): void
    {
        $object = $this->getTestObject([]);
        $this->expectsSendCalledWith(HttpMethod::POST, self::PATH, [], $object);

        $object->create();
    }

    public function testCreateMethodWithIdThrowsException(): void
    {
        $object = $this->getTestObject(['id' => self::GUID]);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot create object with id');

        $object->create();
    }

    public function testUpdateMethodCallsSendWithExpectedParams(): void
    {
        $object = $this->getTestObject(['id' => self::GUID]);
        $this->expectsSendCalledWith(HttpMethod::PUT, [...self::PATH, self::GUID], [], $object);

        $object->update();
    }

    public function testUpdateMethodWithoutIdThrowsException(): void
    {
        $object = $this->getTestObject([]);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot update object without id');

        $object->update();
    }

    public function testDeleteMethodCallsSendWithExpectedParams(): void
    {
        $object = $this->getTestObject(['id' => self::GUID]);
        $this->expectsSendCalledWith(HttpMethod::DELETE, [...self::PATH, self::GUID], [], $object);

        $object->delete();
    }

    public function testDeleteMethodWithoutIdThrowsException(): void
    {
        $object = $this->getTestObject([]);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot delete object without id');

        $object->delete();
    }
}
