<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\AttributeMetadataCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Характеристика модификаций
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-harakteristiki-modifikacij
 *
 * @implements AbstractConcreteObject<AttributeMetadataCollection>
 */
class AttributeMetadata extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::VARIANT,
        Segment::METADATA,
        Segment::CHARACTERISTICS,
    ];
    public const TYPE = Type::ATTRIBUTEMETADATA;
}
