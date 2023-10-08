<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Api\Record\Collections\Entities\AttributeMetadataCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\AttributeMetadata;
use Evgeek\Moysklad\Api\Record\Objects\Entities\PriceType;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Variant;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Collections\Traits\PriceTypeCrudCollectionTrait
 */
class PriceTypeCrudCollectionTraitTest extends CollectionTraitCase
{
    public function testArrayResponseConvertedToCollection(): void
    {
        $priceType1 = PriceType::make($this->ms, ['id' => static::GUID1]);
        $priceType2 = PriceType::make($this->ms, ['id' => static::GUID2]);
        $response = [$priceType1, $priceType2];

        $this->expectsSendCalledWith(
            HttpMethod::GET,
            PriceType::PATH,
            [],
            [],
            $response
        );

        $result = PriceType::collection($this->ms)->get();

        $expectedUrl = Url::API . '/' . implode('/', PriceType::PATH);
        $this->assertSame($expectedUrl, $result->meta->href);
        $this->assertSame(Type::PRICETYPE, $result->meta->type);
        $this->assertSame($priceType1->toArray(), $result->rows[0]->toArray());
        $this->assertSame($priceType2->toArray(), $result->rows[1]->toArray());
    }
}
