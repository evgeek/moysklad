<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PriceList;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Прайс-листов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-prajs-list
 *
 * @implements AbstractConcreteCollection<PriceList>
 */
class PriceListCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PRICELIST,
    ];
    public const TYPE = Type::PRICELIST;
}
