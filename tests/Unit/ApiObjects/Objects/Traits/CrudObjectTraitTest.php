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
        $object = $this->getTestObject(['id' => static::GUID]);
        $this->expectsSendCalledWith(HttpMethod::GET, [...static::PATH, static::GUID], ['expand' => 'field1'], $object);

        $object->expand('field1')->get();
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
        $this->expectsSendCalledWith(HttpMethod::POST, static::PATH, [], $object);

        $object->create();
    }

    public function testCreateMethodWithIdThrowsException(): void
    {
        $object = $this->getTestObject(['id' => static::GUID]);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot create object with id');

        $object->create();
    }

    public function testUpdateMethodCallsSendWithExpectedParams(): void
    {
        $object = $this->getTestObject(['id' => static::GUID]);
        $this->expectsSendCalledWith(HttpMethod::PUT, [...static::PATH, static::GUID], [], $object);

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
        $object = $this->getTestObject(['id' => static::GUID]);
        $this->expectsSendCalledWith(HttpMethod::DELETE, [...static::PATH, static::GUID], [], $object);

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
