<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\PurchaseOrderCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Заказ поставщику
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-postawschiku
 *
 * @implements AbstractConcreteObject<PurchaseOrderCollection>
 */
class PurchaseOrder extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PURCHASEORDER,
    ];
    public const TYPE = Type::PURCHASEORDER;
}
