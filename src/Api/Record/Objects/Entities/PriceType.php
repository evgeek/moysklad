<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\PriceTypeCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Тип цены
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tipy-cen
 *
 * @implements AbstractConcreteObject<PriceTypeCollection>
 */
class PriceType extends AbstractEntity
{
    public const PATH = [
        Segment::CONTEXT,
        Segment::COMPANYSETTINGS,
        Segment::PRICETYPE,
    ];
    public const TYPE = Type::PRICETYPE;
}
