<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\PrepaymentReturnCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Возврат предоплаты
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-predoplaty
 *
 * @implements AbstractConcreteObject<PrepaymentReturnCollection>
 */
class PrepaymentReturn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PREPAYMENTRETURN,
    ];
    public const TYPE = Type::PREPAYMENTRETURN;
}
