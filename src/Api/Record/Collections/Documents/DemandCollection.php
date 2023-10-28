<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Demand;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Отгрузок
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-otgruzka
 *
 * @implements AbstractConcreteCollection<Demand>
 */
class DemandCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::DEMAND,
    ];
    public const TYPE = Type::DEMAND;
}
