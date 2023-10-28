<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\InvoiceOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Loss;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDemand;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailSalesReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailShift;
use Evgeek\Moysklad\Api\Record\Objects\Documents\SalesReturn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Счетов поставщикам
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-postawschika
 *
 * @implements AbstractConcreteCollection<InvoiceOut>
 */
class InvoiceInCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::INVOICEIN,
    ];
    public const TYPE = Type::INVOICEIN;
}
