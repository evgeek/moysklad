<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\InvoiceOut;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Счетов покупателям
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-pokupatelu
 *
 * @implements AbstractConcreteCollection<InvoiceOut>
 */
class InvoiceOutCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::INVOICEOUT,
    ];
    public const TYPE = Type::INVOICEOUT;
}
