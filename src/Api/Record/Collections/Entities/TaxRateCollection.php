<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\TaxRate;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Ставок НДС
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stawka-nds
 *
 * @implements AbstractConcreteCollection<TaxRate>
 */
class TaxRateCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::TAXRATE,
    ];
    public const TYPE = Type::TAXRATE;
}
