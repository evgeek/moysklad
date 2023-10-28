<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentIn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Входящих платежей
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vhodqschij-platezh
 *
 * @implements AbstractConcreteCollection<PaymentIn>
 */
class PaymentInCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PAYMENTIN,
    ];
    public const TYPE = Type::PAYMENTIN;
}
