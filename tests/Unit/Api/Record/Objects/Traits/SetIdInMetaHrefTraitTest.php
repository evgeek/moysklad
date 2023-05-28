<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Objects\Traits;

use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Objects\Traits\SetIdInMetaHrefTrait
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
