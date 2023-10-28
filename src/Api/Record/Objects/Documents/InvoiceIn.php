<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\InvoiceOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\LossCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDemandCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailSalesReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailShiftCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\SalesReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Счет поставщика
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-postawschika
 *
 * @implements AbstractConcreteObject<InvoiceOutCollection>
 */
class InvoiceIn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::INVOICEIN,
    ];
    public const TYPE = Type::INVOICEIN;
}
