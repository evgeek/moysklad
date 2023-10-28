<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\InvoiceInCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Счет поставщика
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-postawschika
 *
 * @implements AbstractConcreteObject<InvoiceInCollection>
 */
class InvoiceIn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::INVOICEIN,
    ];
    public const TYPE = Type::INVOICEIN;
}
