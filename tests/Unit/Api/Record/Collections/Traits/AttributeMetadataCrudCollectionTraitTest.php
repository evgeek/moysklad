<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Api\Record\Collections\Entities\AttributeMetadataCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\AttributeMetadata;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Variant;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Collections\Traits\AttributeMetadataCrudCollectionTrait
 */
class AttributeMetadataCrudCollectionTraitTest extends CollectionTraitCase
{
    public function testTEst(): void
    {
        $response = Variant::make($this->ms, [
            'characteristics' => AttributeMetadata::make($this->ms, ['id' => static::GUID])
        ]);

        $collection = AttributeMetadata::collection($this->ms);
        $this->expectsSendCalledWith(
            HttpMethod::GET,
            ['entity', 'variant', 'metadata'],
            [],
            [],
            $response->toString());

        $result = $collection->get();

        $this->assertNull($result->characteristics);
        $this->assertSame($response->toArray()['characteristics'], $result->toArray()['rows']);
    }
}
