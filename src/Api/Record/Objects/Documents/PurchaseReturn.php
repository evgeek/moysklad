<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\PurchaseReturnCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Возврат поставщику
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-postawschiku
 *
 * @implements AbstractConcreteObject<PurchaseReturnCollection>
 */
class PurchaseReturn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PURCHASERETURN,
    ];
    public const TYPE = Type::PURCHASERETURN;
}
