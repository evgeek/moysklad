<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\PaymentInCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Входящий платеж
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vhodqschij-platezh
 *
 * @implements AbstractConcreteObject<PaymentInCollection>
 */
class PaymentIn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PAYMENTIN,
    ];
    public const TYPE = Type::PAYMENTIN;
}
