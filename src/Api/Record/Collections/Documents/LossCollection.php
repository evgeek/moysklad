<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Loss;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDemand;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailSalesReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailShift;
use Evgeek\Moysklad\Api\Record\Objects\Documents\SalesReturn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Списаний
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-spisanie
 *
 * @implements AbstractConcreteCollection<Loss>
 */
class LossCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::LOSS,
    ];
    public const TYPE = Type::LOSS;
}
