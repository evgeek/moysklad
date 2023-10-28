<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\PrepaymentCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Предоплата
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-predoplata
 *
 * @implements AbstractConcreteObject<PrepaymentCollection>
 */
class Prepayment extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PREPAYMENT,
    ];
    public const TYPE = Type::PREPAYMENT;
}
