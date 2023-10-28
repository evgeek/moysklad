<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\SalesReturnCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Возврат покупателя
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-pokupatelq
 *
 * @implements AbstractConcreteObject<SalesReturnCollection>
 */
class SalesReturn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SALESRETURN,
    ];
    public const TYPE = Type::SALESRETURN;
}
