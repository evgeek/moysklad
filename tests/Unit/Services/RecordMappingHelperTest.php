<?php

namespace Evgeek\Tests\Unit\Services;

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
use Evgeek\Moysklad\Api\Record\Collections\Documents\PrepaymentReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PriceListCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\ProcessingOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PurchaseOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PurchaseReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDrawerCashInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDrawerCashOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\SalesReturnCollection;
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
use Evgeek\Moysklad\Api\Record\Collections\Nested\AccountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\CashierCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\CustomTemplateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\EmbeddedTemplateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\FilesCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ImageCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\NamedFilterCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanMaterialCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanResultCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanStagesCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ReturnToCommissionerPositionCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\StateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\TrackingCodeCollection;
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
use Evgeek\Moysklad\Api\Record\Objects\Documents\PrepaymentReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PriceList;
use Evgeek\Moysklad\Api\Record\Objects\Documents\ProcessingOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\SalesReturn;
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
use Evgeek\Moysklad\Api\Record\Objects\Nested\Account;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Cashier;
use Evgeek\Moysklad\Api\Record\Objects\Nested\CustomTemplate;
use Evgeek\Moysklad\Api\Record\Objects\Nested\EmbeddedTemplate;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Files;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Image;
use Evgeek\Moysklad\Api\Record\Objects\Nested\NamedFilter;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanMaterial;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanResult;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanStages;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ReturnToCommissionerPosition;
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Api\Record\Objects\Nested\TrackingCode;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Moysklad\Formatters\RecordFormat;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\RecordMappingHelper;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Services\RecordMappingHelper */
class RecordMappingHelperTest extends TestCase
{
    public const CONTENT = [
        'name' => 'test_name',
        'archived' => false,
        'amount' => 1.23,
    ];

    /** @dataProvider standardEntities */
    public function testResolvingRegisteredObject(
        string $type,
        string $expectedObjectClass,
        ?string $expectedCollectionClass,
        ObjectInterface|array|string|null $parent = null
    ): void {
        $object = $parent ?
            RecordMappingHelper::resolveNestedObject($this->getMoySklad(), $parent, $type, self::CONTENT) :
            RecordMappingHelper::resolveObject($this->getMoySklad(), $type, self::CONTENT);

        $this->assertInstanceOf($expectedObjectClass, $object);
    }

    public function testResolvingUnregisteredObjectThrowsException(): void
    {
        $type = 'unregistered_type';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Object type '$type' has no mapped class");

        RecordMappingHelper::resolveObject($this->getMoySklad(), $type);
    }

    /** @dataProvider standardEntities */
    public function testResolvingRegisteredCollection(
        string  $type,
        string  $expectedObjectClass,
        ?string $expectedCollectionClass,
        ObjectInterface|array|string|null $parent = null
    ): void {
        if (!$expectedCollectionClass) {
            $this->expectException(InvalidArgumentException::class);
            $this->expectExceptionMessage("Collection type '$type' has no mapped class");
        }

        $object = $parent ?
            RecordMappingHelper::resolveNestedCollection($this->getMoySklad(true), $parent, $type) :
            RecordMappingHelper::resolveCollection($this->getMoySklad(true), $type);

        if ($expectedCollectionClass) {
            $this->assertInstanceOf($expectedCollectionClass, $object);
        }
    }

    public function testResolvingUnregisteredCollectionThrowsException(): void
    {
        $type = 'unregistered_type';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Collection type '$type' has no mapped class");

        RecordMappingHelper::resolveCollection($this->getMoySklad(), $type);
    }

    public function testNestedObjectResolverCannotResolveUnregistered(): void
    {
        $parent = new Product($this->getMoySklad());
        $unregisteredType = 'unregistered_type';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Nested object type '$unregisteredType' has no mapped class");

        RecordMappingHelper::resolveNestedObject($this->getMoySklad(), $parent, $unregisteredType);
    }

    public function testNestedObjectResolverCannotResolveNotNestedType(): void
    {
        $parent = new Product($this->getMoySklad());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Nested object type 'product' has wrong mapped class");

        RecordMappingHelper::resolveNestedObject($this->getMoySklad(), $parent, $parent::TYPE);
    }

    public function testNestedCollectionResolverCannotResolveUnregistered(): void
    {
        $parent = new Product($this->getMoySklad());
        $unregisteredType = 'unregistered_type';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Nested collection type '$unregisteredType' has no mapped class");

        RecordMappingHelper::resolveNestedCollection($this->getMoySklad(), $parent, $unregisteredType);
    }

    public function testNestedCollectionResolverCannotResolveNotNestedType(): void
    {
        $parent = new Product($this->getMoySklad());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Nested collection type 'product' has wrong mapped class");

        RecordMappingHelper::resolveNestedCollection($this->getMoySklad(), $parent, $parent::TYPE);
    }

    public static function standardEntities(): array
    {
        $ms = new MoySklad(['']);

        return [
            Type::ASSORTMENT => [Type::ASSORTMENT, Assortment::class, AssortmentCollection::class],
            Type::BONUSTRANSACTION => [Type::BONUSTRANSACTION, BonusTransaction::class, BonusTransactionCollection::class],
            Type::BONUSPROGRAM => [Type::BONUSPROGRAM, BonusProgram::class, BonusProgramCollection::class],
            Type::CURRENCY => [Type::CURRENCY, Currency::class, CurrencyCollection::class],
            Type::WEBHOOK => [Type::WEBHOOK, Webhook::class, WebhookCollection::class],
            Type::WEBHOOKSTOCK => [Type::WEBHOOKSTOCK, WebhookStock::class, WebhookStockCollection::class],
            Type::PRODUCTFOLDER => [Type::PRODUCTFOLDER, ProductFolder::class, ProductFolderCollection::class],
            Type::CONTRACT => [Type::CONTRACT, Contract::class, ContractCollection::class],
            Type::UOM => [Type::UOM, Uom::class, UomCollection::class],
            Type::TASK => [Type::TASK, Task::class, TaskCollection::class],
            Type::IMAGE => [Type::IMAGE, Image::class, ImageCollection::class, Product::make($ms)],
            Type::SALESCHANNEL => [Type::SALESCHANNEL, SalesChannel::class, SalesChannelCollection::class],
            Type::CASHIER => [Type::CASHIER, Cashier::class, CashierCollection::class, Product::class],
            Type::TRACKINGCODE => [Type::TRACKINGCODE, TrackingCode::class, TrackingCodeCollection::class, Product::class],
            Type::BUNDLE => [Type::BUNDLE, Bundle::class, BundleCollection::class],
            Type::COUNTERPARTY => [Type::COUNTERPARTY, Counterparty::class, CounterpartyCollection::class],
            Type::VARIANT => [Type::VARIANT, Variant::class, VariantCollection::class],
            Type::COMPANYSETTINGS => [Type::COMPANYSETTINGS, CompanySettings::class, null],
            Type::USERSETTINGS => [Type::USERSETTINGS, UserSettings::class, null],
            Type::GROUP => [Type::GROUP, Group::class, GroupCollection::class],
            Type::SUBSCRIPTION => [Type::SUBSCRIPTION, Subscription::class, null],
            Type::CUSTOMROLE => [Type::CUSTOMROLE, CustomRole::class, CustomRoleCollection::class],
            Type::CUSTOMENTITY => [Type::CUSTOMENTITY, CustomEntity::class, CustomEntityCollection::class],
            Type::PROJECT => [Type::PROJECT, Project::class, ProjectCollection::class],
            Type::REGION => [Type::REGION, Region::class, RegionCollection::class],
            Type::CONSIGNMENT => [Type::CONSIGNMENT, Consignment::class, ConsignmentCollection::class],
            Type::DISCOUNT => [Type::DISCOUNT, Discount::class, DiscountCollection::class],
            Type::ACCUMULATIONDISCOUNT => [Type::ACCUMULATIONDISCOUNT, AccumulationDiscount::class, AccumulationDiscountCollection::class],
            Type::PERSONALDISCOUNT => [Type::PERSONALDISCOUNT, PersonalDiscount::class, PersonalDiscountCollection::class],
            Type::SPECIALPRICEDISCOUNT => [Type::SPECIALPRICEDISCOUNT, SpecialPriceDiscount::class, SpecialPriceDiscountCollection::class],
            Type::STORE => [Type::STORE, Store::class, StoreCollection::class],
            Type::EMPLOYEE => [Type::EMPLOYEE, Employee::class, EmployeeCollection::class],
            Type::NAMEDFILTER => [Type::NAMEDFILTER, NamedFilter::class, NamedFilterCollection::class, 'product'],
            Type::TAXRATE => [Type::TAXRATE, TaxRate::class, TaxRateCollection::class],
            Type::STATE => [Type::STATE, State::class, StateCollection::class, Counterparty::class],
            Type::EXPENSEITEM => [Type::EXPENSEITEM, ExpenseItem::class, ExpenseItemCollection::class],
            Type::COUNTRY => [Type::COUNTRY, Country::class, CountryCollection::class],
            Type::PROCESSINGPLAN => [Type::PROCESSINGPLAN, ProcessingPlan::class, ProcessingPlanCollection::class],
            Type::PROCESSINGPLANSTAGES => [Type::PROCESSINGPLANSTAGES, ProcessingPlanStages::class, ProcessingPlanStagesCollection::class, ProcessingPlan::make($ms)],
            Type::PROCESSINGPLANMATERIAL => [Type::PROCESSINGPLANMATERIAL, ProcessingPlanMaterial::class, ProcessingPlanMaterialCollection::class, ProcessingPlan::make($ms)],
            Type::PROCESSINGPLANRESULT => [Type::PROCESSINGPLANRESULT, ProcessingPlanResult::class, ProcessingPlanResultCollection::class, ProcessingPlan::make($ms)],
            Type::PROCESSINGPROCESS => [Type::PROCESSINGPROCESS, ProcessingProcess::class, ProcessingProcessCollection::class],
            Type::PRICETYPE => [Type::PRICETYPE, PriceType::class, PriceTypeCollection::class],
            Type::PRODUCT => [Type::PRODUCT, Product::class, ProductCollection::class],
            Type::RETAILSTORE => [Type::RETAILSTORE, RetailStore::class, RetailStoreCollection::class],
            Type::SERVICE => [Type::SERVICE, Service::class, ServiceCollection::class],
            Type::FILES => [Type::FILES, Files::class, FilesCollection::class, Counterparty::make($ms)],
            Type::ATTRIBUTEMETADATA => [Type::ATTRIBUTEMETADATA, AttributeMetadata::class, AttributeMetadataCollection::class],
            Type::EMBEDDEDTEMPLATE => [Type::EMBEDDEDTEMPLATE, EmbeddedTemplate::class, EmbeddedTemplateCollection::class, Counterparty::make($ms)],
            Type::CUSTOMTEMPLATE => [Type::CUSTOMTEMPLATE, CustomTemplate::class, CustomTemplateCollection::class, Counterparty::make($ms)],
            Type::ORGANIZATION => [Type::ORGANIZATION, Organization::class, OrganizationCollection::class],
            Type::ACCOUNT => [Type::ACCOUNT, Account::class, AccountCollection::class, Organization::make($ms)],
            Type::PROCESSINGSTAGE => [Type::PROCESSINGSTAGE, ProcessingStage::class, ProcessingStageCollection::class],
            Type::RETAILDRAWERCASHIN => [Type::RETAILDRAWERCASHIN, RetailDrawerCashIn::class, RetailDrawerCashInCollection::class],
            Type::INTERNALORDER => [Type::INTERNALORDER, InternalOrder::class, InternalOrderCollection::class],
            Type::SALESRETURN => [Type::SALESRETURN, SalesReturn::class, SalesReturnCollection::class],
            Type::PURCHASERETURN => [Type::PURCHASERETURN, PurchaseReturn::class, PurchaseReturnCollection::class],
            Type::PREPAYMENTRETURN => [Type::PREPAYMENTRETURN, PrepaymentReturn::class, PrepaymentReturnCollection::class],
            Type::PAYMENTIN => [Type::PAYMENTIN, PaymentIn::class, PaymentInCollection::class],
            Type::COMMISSIONREPORTOUT => [Type::COMMISSIONREPORTOUT, CommissionReportOut::class, CommissionReportOutCollection::class],
            Type::RETAILDRAWERCASHOUT => [Type::RETAILDRAWERCASHOUT, RetailDrawerCashOut::class, RetailDrawerCashOutCollection::class],
            Type::PROCESSINGORDER => [Type::PROCESSINGORDER, ProcessingOrder::class, ProcessingOrderCollection::class],
            Type::CUSTOMERORDER => [Type::CUSTOMERORDER, CustomerOrder::class, CustomerOrderCollection::class],
            Type::PURCHASEORDER => [Type::PURCHASEORDER, PurchaseOrder::class, PurchaseOrderCollection::class],
            Type::INVENTORY => [Type::INVENTORY, Inventory::class, InventoryCollection::class],
            Type::PAYMENTOUT => [Type::PAYMENTOUT, PaymentOut::class, PaymentOutCollection::class],
            Type::COUNTERPARTYADJUSTMENT => [Type::COUNTERPARTYADJUSTMENT, CounterpartyAdjustment::class, CounterpartyAdjustmentCollection::class],
            Type::ENTER => [Type::ENTER, Enter::class, EnterCollection::class],
            Type::DEMAND => [Type::DEMAND, Demand::class, DemandCollection::class],
            Type::MOVE => [Type::MOVE, Move::class, MoveCollection::class],
            Type::RETURNTOCOMMISSIONERPOSITION => [Type::RETURNTOCOMMISSIONERPOSITION, ReturnToCommissionerPosition::class, ReturnToCommissionerPositionCollection::class, Product::class],
            Type::COMMISSIONREPORTIN => [Type::COMMISSIONREPORTIN, CommissionReportIn::class, CommissionReportInCollection::class],
            Type::PRICELIST => [Type::PRICELIST, PriceList::class, PriceListCollection::class],
        ];
    }

    private function getMoySklad(bool $withRecordFormat = false): MoySklad
    {
        return $withRecordFormat ?
            new MoySklad(['token'], new RecordFormat()) :
            new MoySklad(['token']);
    }
}
