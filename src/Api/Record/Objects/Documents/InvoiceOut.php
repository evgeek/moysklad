<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\InvoiceOutCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Счет покупателю
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-pokupatelu
 *
 * @implements AbstractConcreteObject<InvoiceOutCollection>
 */
class InvoiceOut extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::INVOICEOUT,
    ];
    public const TYPE = Type::INVOICEOUT;
}
