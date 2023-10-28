<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CommissionReportIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CommissionReportOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CounterpartyAdjustment;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Demand;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Enter;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Inventory;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Move;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PriceList;
use Evgeek\Moysklad\Api\Record\Objects\Documents\ProcessingOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\SalesReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Supply;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Приемок
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-priemka
 *
 * @implements AbstractConcreteCollection<Supply>
 */
class SupplyCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SUPPLY,
    ];
    public const TYPE = Type::SUPPLY;
}
