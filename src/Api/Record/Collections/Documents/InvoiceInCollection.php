<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\InvoiceIn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Счетов поставщикам
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-postawschika
 *
 * @implements AbstractConcreteCollection<InvoiceIn>
 */
class InvoiceInCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::INVOICEIN,
    ];
    public const TYPE = Type::INVOICEIN;
}
