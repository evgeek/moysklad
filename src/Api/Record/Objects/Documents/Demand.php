<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CommissionReportOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CounterpartyAdjustmentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\DemandCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\EnterCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\InventoryCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PaymentInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PaymentOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\ProcessingOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PurchaseOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PurchaseReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDrawerCashOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\SalesReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Отгрузка
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-otgruzka
 *
 * @implements AbstractConcreteObject<DemandCollection>
 */
class Demand extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::DEMAND,
    ];
    public const TYPE = Type::DEMAND;
}
