<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Collections\Traits\AttributeMetadataCrudCollectionTrait;
use Evgeek\Moysklad\Api\Record\Objects\Entities\AttributeMetadata;
use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Характеристик модификаций
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-harakteristiki-modifikacij
 *
 * @implements AbstractConcreteCollection<AttributeMetadata>
 */
class AttributeMetadataCollection extends AbstractEntityCollection
{
    use AttributeMetadataCrudCollectionTrait;

    public const PATH = [
        Segment::ENTITY,
        Segment::VARIANT,
        Segment::METADATA,
        Segment::CHARACTERISTICS,
    ];
    public const TYPE = Type::ATTRIBUTEMETADATA;
}
