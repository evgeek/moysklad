<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\SalesReturn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Возвратов покупателя
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-pokupatelq
 *
 * @implements AbstractConcreteCollection<SalesReturn>
 */
class SalesReturnCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SALESRETURN,
    ];
    public const TYPE = Type::SALESRETURN;
}
