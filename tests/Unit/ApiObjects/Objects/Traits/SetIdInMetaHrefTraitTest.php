<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Objects\Traits\SetIdInMetaHrefTrait
 */
class SetIdInMetaHrefTraitTest extends ObjectTraitCase
{
    private const GUID2 = 'f731148b-a93d-11ed-0a80-0fba0011a6c6';

    private string $expectedUrl = '';

    protected function setUp(): void
    {
        parent::setUp();

        $this->expectedUrl = Url::API . '/' . implode('/', static::PATH);
    }

    public function testSetNotGuidId(): void
    {
        $object = $this->getTestObject();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('id must be a guid');

        $object->id = 'wrong-guid';
    }

    public function testMetaHiddenWithoutIdAndRevealsWithId(): void
    {
        $object = $this->getTestObject();
        $this->assertFalse(isset($object->toArray()['meta']));

        $object->id = static::GUID;
        $this->assertTrue(isset($object->toArray()['meta']));

        $object->id = null;
        $this->assertFalse(isset($object->toArray()['meta']));
    }

    public function testSetIdInsteadOfEmptyIdAddedIdToPath(): void
    {
        $object = $this->getTestObject();
        $this->assertSame($this->expectedUrl, $object->meta->href);

        $object->id = static::GUID;
        $this->assertSame($this->expectedUrl . '/' . static::GUID, $object->meta->href);
    }

    public function testSetIdInsteadOfAnotherIdReplacedAnotherIdInPath(): void
    {
        $object = $this->getTestObject(['id' => static::GUID]);
        $this->assertSame($this->expectedUrl . '/' . static::GUID, $object->meta->href);

        $object->id = static::GUID2;
        $this->assertSame($this->expectedUrl . '/' . static::GUID2, $object->meta->href);
    }

    public function testSetMetaWithoutIdHidesResultAndViceVersa(): void
    {
        $object = $this->getTestObject(['id' => static::GUID]);
        $this->assertTrue(isset($object->toArray()['meta']));

        $metaWithId = $metaWithoutId = (array) $object->meta;
        [$path, $params] = Url::parsePathAndParams($metaWithoutId['href']);
        array_pop($path);
        $metaWithoutId['href'] = Url::makeFromPathAndParams($path, $params);

        $object->meta = $metaWithoutId;
        $this->assertFalse(isset($object->toArray()['meta']));

        $object->meta = $metaWithId;
        $this->assertTrue(isset($object->toArray()['meta']));
    }

    public function testSetMetaWithoutHrefThrowsException(): void
    {
        $object = $this->getTestObject();
        $meta = $this->ms->meta()->create(static::PATH, static::TYPE);

        unset($meta['href']);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Meta must contain href and type');

        $object->meta = $meta;
    }

    public function testSetMetaWithoutTypeThrowsException(): void
    {
        $object = $this->getTestObject();
        $meta = $this->ms->meta()->create(static::PATH, static::TYPE);

        $meta['type'] = null;

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Meta must contain href and type');

        $object->meta = $meta;
    }

    public function testMetaPropertyCannotBeUnset(): void
    {
        $object = $this->getTestObject();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Meta property cannot be unset');

        $object->meta = null;
    }

    public function testMetaPropertyExistsAlways(): void
    {
        $object = $this->getTestObject();

        $this->assertFalse(isset($object->toArray()['meta']));
        $this->assertTrue(isset($object->meta));
    }

    /** @dataProvider propertyNames */
    public function testSettingPropertyToNullUnsetIt(string $name): void
    {
        $object = $this->getTestObject([$name => static::GUID]);
        $this->assertTrue(isset($object->{$name}));

        $object->{$name} = null;
        $this->assertFalse(isset($object->{$name}));
    }

    public static function propertyNames(): array
    {
        return [
            ['id'],
            ['name'],
            ['random-property'],
        ];
    }
}
