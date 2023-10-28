<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CommissionReportOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CounterpartyAdjustment;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Inventory;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\ProcessingOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\SalesReturn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Корректировок баланса контрагента
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-korrektirowka-balansa-kontragenta
 *
 * @implements AbstractConcreteCollection<CounterpartyAdjustment>
 */
class CounterpartyAdjustmentCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::COUNTERPARTYADJUSTMENT,
    ];
    public const TYPE = Type::COUNTERPARTYADJUSTMENT;
}