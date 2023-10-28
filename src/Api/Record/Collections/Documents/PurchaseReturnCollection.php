<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseReturn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Возвратов поставщику
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-postawschiku
 *
 * @implements AbstractConcreteCollection<PurchaseReturn>
 */
class PurchaseReturnCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PURCHASERETURN,
    ];
    public const TYPE = Type::PURCHASERETURN;
}
