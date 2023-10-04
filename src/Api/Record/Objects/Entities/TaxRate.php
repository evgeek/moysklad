<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\TaxRateCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Ставка НДС
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stawka-nds
 *
 * @implements AbstractConcreteObject<TaxRateCollection>
 */
class TaxRate extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::TAXRATE,
    ];
    public const TYPE = Type::TAXRATE;
}
