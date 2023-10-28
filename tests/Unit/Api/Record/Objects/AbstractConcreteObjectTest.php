<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Objects;

use Evgeek\Moysklad\Api\Record\Collections\Documents\CashInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CommissionReportInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CommissionReportOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CounterpartyAdjustmentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\DemandCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\EnterCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\InternalOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\InventoryCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\MoveCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PaymentInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PaymentOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PrepaymentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PrepaymentReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PriceListCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\ProcessingOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PurchaseOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PurchaseReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDrawerCashInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDrawerCashOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\SalesReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\SupplyCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\AccumulationDiscountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\AssortmentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\AttributeMetadataCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\BonusProgramCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\BonusTransactionCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\BundleCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ConsignmentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ContractCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\CounterpartyCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\CountryCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\CurrencyCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\CustomEntityCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\CustomRoleCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\DiscountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ExpenseItemCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\GroupCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\OrganizationCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\PersonalDiscountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\PriceTypeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingPlanCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingProcessCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingStageCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductFolderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProjectCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\RegionCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\RetailStoreCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\SalesChannelCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ServiceCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\SpecialPriceDiscountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\StoreCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\TaskCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\TaxRateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\UomCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\VariantCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\WebhookCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\WebhookStockCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\StateCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CashIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CommissionReportIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CommissionReportOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CounterpartyAdjustment;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Demand;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Enter;
use Evgeek\Moysklad\Api\Record\Objects\Documents\InternalOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Inventory;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Move;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Prepayment;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PrepaymentReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PriceList;
use Evgeek\Moysklad\Api\Record\Objects\Documents\ProcessingOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\SalesReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Supply;
use Evgeek\Moysklad\Api\Record\Objects\Entities\AccumulationDiscount;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Assortment;
use Evgeek\Moysklad\Api\Record\Objects\Entities\AttributeMetadata;
use Evgeek\Moysklad\Api\Record\Objects\Entities\BonusProgram;
use Evgeek\Moysklad\Api\Record\Objects\Entities\BonusTransaction;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Bundle;
use Evgeek\Moysklad\Api\Record\Objects\Entities\CompanySettings;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Consignment;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Contract;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Counterparty;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Country;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Currency;
use Evgeek\Moysklad\Api\Record\Objects\Entities\CustomEntity;
use Evgeek\Moysklad\Api\Record\Objects\Entities\CustomRole;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Discount;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ExpenseItem;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Group;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Organization;
use Evgeek\Moysklad\Api\Record\Objects\Entities\PersonalDiscount;
use Evgeek\Moysklad\Api\Record\Objects\Entities\PriceType;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingPlan;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingProcess;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingStage;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProductFolder;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Project;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Region;
use Evgeek\Moysklad\Api\Record\Objects\Entities\RetailStore;
use Evgeek\Moysklad\Api\Record\Objects\Entities\SalesChannel;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Service;
use Evgeek\Moysklad\Api\Record\Objects\Entities\SpecialPriceDiscount;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Store;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Subscription;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Task;
use Evgeek\Moysklad\Api\Record\Objects\Entities\TaxRate;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Uom;
use Evgeek\Moysklad\Api\Record\Objects\Entities\UserSettings;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Variant;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Webhook;
use Evgeek\Moysklad\Api\Record\Objects\Entities\WebhookStock;
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject
 */
class AbstractConcreteObjectTest extends KnownObjectTestCase
{
    public static function classAndCollection(): array
    {
        return [
            Type::ASSORTMENT => [Assortment::class, AssortmentCollection::class],
            Type::BONUSTRANSACTION => [BonusTransaction::class, BonusTransactionCollection::class],
            Type::BONUSPROGRAM => [BonusProgram::class, BonusProgramCollection::class],
            Type::CURRENCY => [Currency::class, CurrencyCollection::class],
            Type::WEBHOOK => [Webhook::class, WebhookCollection::class],
            Type::WEBHOOKSTOCK => [WebhookStock::class, WebhookStockCollection::class],
            Type::PRODUCTFOLDER => [ProductFolder::class, ProductFolderCollection::class],
            Type::CONTRACT => [Contract::class, ContractCollection::class],
            Type::UOM => [Uom::class, UomCollection::class],
            Type::TASK => [Task::class, TaskCollection::class],
            Type::SALESCHANNEL => [SalesChannel::class, SalesChannelCollection::class],
            Type::BUNDLE => [Bundle::class, BundleCollection::class],
            Type::COUNTERPARTY => [Counterparty::class, CounterpartyCollection::class],
            Type::VARIANT => [Variant::class, VariantCollection::class],
            Type::COMPANYSETTINGS => [CompanySettings::class, null],
            Type::USERSETTINGS => [UserSettings::class, null],
            Type::GROUP => [Group::class, GroupCollection::class],
            Type::SUBSCRIPTION => [Subscription::class, null],
            Type::CUSTOMROLE => [CustomRole::class, CustomRoleCollection::class],
            Type::CUSTOMENTITY => [CustomEntity::class, CustomEntityCollection::class],
            Type::PROJECT => [Project::class, ProjectCollection::class],
            Type::REGION => [Region::class, RegionCollection::class],
            Type::CONSIGNMENT => [Consignment::class, ConsignmentCollection::class],
            Type::DISCOUNT => [Discount::class, DiscountCollection::class],
            Type::ACCUMULATIONDISCOUNT => [AccumulationDiscount::class, AccumulationDiscountCollection::class],
            Type::PERSONALDISCOUNT => [PersonalDiscount::class, PersonalDiscountCollection::class],
            Type::SPECIALPRICEDISCOUNT => [SpecialPriceDiscount::class, SpecialPriceDiscountCollection::class],
            Type::STORE => [Store::class, StoreCollection::class],
            Type::EMPLOYEE => [Employee::class, EmployeeCollection::class],
            Type::TAXRATE => [TaxRate::class, TaxRateCollection::class],
            Type::EXPENSEITEM => [ExpenseItem::class, ExpenseItemCollection::class],
            Type::COUNTRY => [Country::class, CountryCollection::class],
            Type::PROCESSINGPLAN => [ProcessingPlan::class, ProcessingPlanCollection::class],
            Type::PROCESSINGPROCESS => [ProcessingProcess::class, ProcessingProcessCollection::class],
            Type::PRICETYPE => [PriceType::class, PriceTypeCollection::class],
            Type::PRODUCT => [Product::class, ProductCollection::class],
            Type::RETAILSTORE => [RetailStore::class, RetailStoreCollection::class],
            Type::SERVICE => [Service::class, ServiceCollection::class],
            Type::ATTRIBUTEMETADATA => [AttributeMetadata::class, AttributeMetadataCollection::class],
            Type::ORGANIZATION => [Organization::class, OrganizationCollection::class],
            Type::PROCESSINGSTAGE => [ProcessingStage::class, ProcessingStageCollection::class],
            Type::RETAILDRAWERCASHIN => [RetailDrawerCashIn::class, RetailDrawerCashInCollection::class],
            Type::INTERNALORDER => [InternalOrder::class, InternalOrderCollection::class],
            Type::SALESRETURN => [SalesReturn::class, SalesReturnCollection::class],
            Type::PURCHASERETURN => [PurchaseReturn::class, PurchaseReturnCollection::class],
            Type::PREPAYMENTRETURN => [PrepaymentReturn::class, PrepaymentReturnCollection::class],
            Type::PAYMENTIN => [PaymentIn::class, PaymentInCollection::class],
            Type::COMMISSIONREPORTOUT => [CommissionReportOut::class, CommissionReportOutCollection::class],
            Type::RETAILDRAWERCASHOUT => [RetailDrawerCashOut::class, RetailDrawerCashOutCollection::class],
            Type::PROCESSINGORDER => [ProcessingOrder::class, ProcessingOrderCollection::class],
            Type::CUSTOMERORDER => [CustomerOrder::class, CustomerOrderCollection::class],
            Type::PURCHASEORDER => [PurchaseOrder::class, PurchaseOrderCollection::class],
            Type::INVENTORY => [Inventory::class, InventoryCollection::class],
            Type::PAYMENTOUT => [PaymentOut::class, PaymentOutCollection::class],
            Type::COUNTERPARTYADJUSTMENT => [CounterpartyAdjustment::class, CounterpartyAdjustmentCollection::class],
            Type::ENTER => [Enter::class, EnterCollection::class],
            Type::DEMAND => [Demand::class, DemandCollection::class],
            Type::MOVE => [Move::class, MoveCollection::class],
            Type::COMMISSIONREPORTIN => [CommissionReportIn::class, CommissionReportInCollection::class],
            Type::PRICELIST => [PriceList::class, PriceListCollection::class],
            Type::PREPAYMENT => [Prepayment::class, PrepaymentCollection::class],
            Type::SUPPLY => [Supply::class, SupplyCollection::class],
            Type::CASHIN => [CashIn::class, CashInCollection::class],
        ];
    }
}
