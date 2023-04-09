<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\Services\Url;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Objects\Traits\FillMetaObjectTrait
 */
class FillMetaObjectTraitTest extends ObjectTraitCase
{
    public function testExistingMetaIsPreserved(): void
    {
        $meta = $this->ms->meta()->create(['random', 'path'], 'random_type');
        $object = $this->getTestObject(['meta' => $meta]);

        $this->assertSame($meta, (array) $object->meta);
    }

    public function testNotExistingMetaWithoutIdMakesFromPathAndType(): void
    {
        $object = $this->getTestObject();
        $expectedMeta = [
            'href' => Url::API . '/' . implode('/', static::PATH),
            'type' => static::TYPE,
            'mediaType' => 'application/json',
        ];

        $this->assertSame($expectedMeta, (array) $object->meta);
    }

    public function testNotExistingMetaWithIdMakesFromPathAndTypeAndId(): void
    {
        $object = $this->getTestObject(['id' => static::GUID]);
        $expectedMeta = [
            'href' => Url::API . '/' . implode('/', [...static::PATH, static::GUID]),
            'type' => static::TYPE,
            'mediaType' => 'application/json',
        ];

        $this->assertSame($expectedMeta, (array) $object->meta);
    }
}
