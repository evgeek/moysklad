<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Api\Record\Objects\Entities\AttributeMetadata;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Variant;
use Evgeek\Moysklad\Enums\HttpMethod;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Collections\Traits\AttributeMetadataCrudCollectionTrait
 */
class AttributeMetadataCrudCollectionTraitTest extends CollectionTraitCase
{
    public function testCharacteristicsExtractsAsRows(): void
    {
        $attributeMetadata1 = AttributeMetadata::make($this->ms, ['id' => static::GUID1]);
        $attributeMetadata2 = AttributeMetadata::make($this->ms, ['id' => static::GUID2]);
        $response = Variant::make($this->ms, [
            'characteristics' => [
                $attributeMetadata1,
                $attributeMetadata2,
            ],
        ]);

        $this->expectsSendCalledWith(
            HttpMethod::GET,
            ['entity', 'variant', 'metadata'],
            [],
            [],
            $response->toString()
        );

        $result = AttributeMetadata::collection($this->ms)->get();

        $this->assertNull($result->characteristics);
        $this->assertSame($response->toArray()['characteristics'], $result->toArray()['rows']);
        $this->assertSame($attributeMetadata1->toArray(), $result->rows[0]->toArray());
        $this->assertSame($attributeMetadata2->toArray(), $result->rows[1]->toArray());
    }
}
