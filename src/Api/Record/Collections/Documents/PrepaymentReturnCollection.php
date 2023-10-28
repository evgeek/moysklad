<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PrepaymentReturn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Возвратов предоплаты
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-predoplaty
 *
 * @implements AbstractConcreteCollection<PrepaymentReturn>
 */
class PrepaymentReturnCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PREPAYMENTRETURN,
    ];
    public const TYPE = Type::PREPAYMENTRETURN;
}
