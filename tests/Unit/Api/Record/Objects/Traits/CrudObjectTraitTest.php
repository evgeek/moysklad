<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Objects\Traits;

use Evgeek\Moysklad\Enums\HttpMethod;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Objects\Traits\CrudObjectTrait
 */
class CrudObjectTraitTest extends ObjectTraitCase
{
    public function testGetMethodCallsSendWithExpectedParams(): void
    {
        $object = $this->getTestObject(['id' => static::GUID]);
        $this->expectsSendCalledWith(HttpMethod::GET, [...static::PATH, static::GUID], ['expand' => 'field1'], $object);

        $object->expand('field1')->get();
    }

    public function testCreateMethodCallsSendWithExpectedParams(): void
    {
        $object = $this->getTestObject();
        $this->expectsSendCalledWith(HttpMethod::POST, static::PATH, [], $object);

        $object->create();
    }

    public function testUpdateMethodCallsSendWithExpectedParams(): void
    {
        $object = $this->getTestObject(['id' => static::GUID]);
        $this->expectsSendCalledWith(HttpMethod::PUT, [...static::PATH, static::GUID], [], $object);

        $object->update();
    }

    public function testDeleteMethodCallsSendWithExpectedParams(): void
    {
        $object = $this->getTestObject(['id' => static::GUID]);
        $this->expectsSendCalledWith(HttpMethod::DELETE, [...static::PATH, static::GUID], [], $object);

        $object->delete();
    }

    public function testReceivedNotCollectionThrows()
    {
        $object = $this->getTestObject();
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, [], $object, ['rows' => []]);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Response must be an object, collection received');
        $object->get();
    }
}
