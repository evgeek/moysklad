<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\Traits\PriceTypeCrudCollectionTrait;
use Evgeek\Moysklad\Api\Record\Objects\Entities\PriceType;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Типов цен
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tipy-cen
 *
 * @implements AbstractConcreteCollection<PriceType>
 */
class PriceTypeCollection extends AbstractEntityCollection
{
    use PriceTypeCrudCollectionTrait;

    public const PATH = [
        Segment::CONTEXT,
        Segment::COMPANYSETTINGS,
        Segment::PRICETYPE,
    ];
    public const TYPE = Type::PRICETYPE;
}
