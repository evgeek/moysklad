<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\PriceListCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Прайс-лист
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-prajs-list
 *
 * @implements AbstractConcreteObject<PriceListCollection>
 */
class PriceList extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PRICELIST,
    ];
    public const TYPE = Type::PRICELIST;
}
