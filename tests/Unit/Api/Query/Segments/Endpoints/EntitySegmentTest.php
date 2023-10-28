<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\Endpoints\EntitySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CashInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CashOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CommissionReportInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CommissionReportOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CounterpartyAdjustmentSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CustomerOrderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\DemandSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\EnterSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\InternalOrderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\InventorySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\InvoiceOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\LossSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\MoveSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PaymentInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PaymentOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PrepaymentReturnSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PrepaymentSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PriceListSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\ProcessingOrderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PurchaseOrderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PurchaseReturnSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailDemandSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailDrawerCashInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailDrawerCashOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailSalesReturnSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailShiftSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\SalesReturnSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\SupplySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\AccumulationDiscountSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\AssortmentSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\BonusProgramSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\BonusTransactionSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\BundleSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ConsignmentSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ContractSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\CounterpartySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\CountrySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\CurrencySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\CustomEntitySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\DiscountSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\EmployeeSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ExpenseItemSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\GroupSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\OrganizationSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\PersonalDiscountSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProcessingPlanSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProcessingProcessSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProcessingStageSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProductFolderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProductSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProjectSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\RegionSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\RetailStoreSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\RoleSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\SalesChannelSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ServiceSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\SpecialPriceDiscountSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\StoreSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\TaskSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\TaxRateSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\UomSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\VariantSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\WebhookSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\WebhookStockSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\AccountsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CashiersSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CustomTemplateSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\EmbeddedTemplateSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\FilesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ImagesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\MaterialsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\NamedFilterSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ProductsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ReturnToCommissionerPositionsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StagesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StatesSegment;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Tests\Unit\Api\Query\Segments\SegmentTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Endpoints\EntitySegment
 */
class EntitySegmentTest extends SegmentTestCase
{
    protected string $builderClass = EntitySegment::class;

    public static function methodsWithCorrespondingSegmentClass(): array
    {
        return [
            Type::ASSORTMENT => ['assortment', Segment::ASSORTMENT, AssortmentSegment::class],
            Type::BONUSTRANSACTION => ['bonustransaction', Segment::BONUSTRANSACTION, BonusTransactionSegment::class],
            Type::BONUSPROGRAM => ['bonusprogram', Segment::BONUSPROGRAM, BonusProgramSegment::class],
            Type::CURRENCY => ['currency', Segment::CURRENCY, CurrencySegment::class],
            Type::WEBHOOK => ['webhook', Segment::WEBHOOK, WebhookSegment::class],
            Type::WEBHOOKSTOCK => ['webhookstock', Segment::WEBHOOKSTOCK, WebhookStockSegment::class],
            Type::PRODUCTFOLDER => ['productfolder', Segment::PRODUCTFOLDER, ProductFolderSegment::class],
            Type::CONTRACT => ['contract', Segment::CONTRACT, ContractSegment::class],
            Type::UOM => ['uom', Segment::UOM, UomSegment::class],
            Type::TASK => ['task', Segment::TASK, TaskSegment::class],
            Type::IMAGE => ['images', Segment::IMAGES, ImagesSegment::class, ['bundle', static::GUID1]],
            Type::SALESCHANNEL => ['saleschannel', Segment::SALESCHANNEL, SalesChannelSegment::class],
            Type::CASHIER => ['cashiers', Segment::CASHIERS, CashiersSegment::class, ['retailstore', static::GUID1]],
//            Type::TRACKINGCODE => ['trackingCodes', TrackingCodesSegment::class, ['supply', 'ea05e0c9-8667-11e7-8a7f-40d000000060', 'positions', '161d25a8-1477-11ec-ac18-000b00000002']],
            Type::BUNDLE => ['bundle', Segment::BUNDLE, BundleSegment::class],
            Type::COUNTERPARTY => ['counterparty', Segment::COUNTERPARTY, CounterpartySegment::class],
            Type::VARIANT => ['variant', Segment::VARIANT, VariantSegment::class],
            Type::GROUP => ['group', Segment::GROUP, GroupSegment::class],
            Type::CUSTOMROLE => ['role', Segment::ROLE, RoleSegment::class],
            Type::CUSTOMENTITY => ['customentity', Segment::CUSTOMENTITY, CustomEntitySegment::class],
            Type::PROJECT => ['project', Segment::PROJECT, ProjectSegment::class],
            Type::REGION => ['region', Segment::REGION, RegionSegment::class],
            Type::CONSIGNMENT => ['consignment', Segment::CONSIGNMENT, ConsignmentSegment::class],
            Type::DISCOUNT => ['discount', Segment::DISCOUNT, DiscountSegment::class],
            Type::ACCUMULATIONDISCOUNT => ['accumulationdiscount', Segment::ACCUMULATIONDISCOUNT, AccumulationDiscountSegment::class],
            Type::PERSONALDISCOUNT => ['personaldiscount', Segment::PERSONALDISCOUNT, PersonalDiscountSegment::class],
            Type::SPECIALPRICEDISCOUNT => ['specialpricediscount', Segment::SPECIALPRICEDISCOUNT, SpecialPriceDiscountSegment::class],
            Type::STORE => ['store', Segment::STORE, StoreSegment::class],
            Type::EMPLOYEE => ['employee', Segment::EMPLOYEE, EmployeeSegment::class],
            Type::NAMEDFILTER => ['namedfilter', Segment::NAMEDFILTER, NamedFilterSegment::class, ['product']],
            Type::TAXRATE => ['taxrate', Segment::TAXRATE, TaxRateSegment::class],
            Type::STATE => ['states', Segment::STATES, StatesSegment::class, ['counterparty', 'metadata']],
            Type::EXPENSEITEM => ['expenseitem', Segment::EXPENSEITEM, ExpenseItemSegment::class],
            Type::COUNTRY => ['country', Segment::COUNTRY, CountrySegment::class],
            Type::PROCESSINGPLAN => ['processingplan', Segment::PROCESSINGPLAN, ProcessingPlanSegment::class],
            Type::PROCESSINGPLANSTAGES => ['stages', Segment::STAGES, StagesSegment::class, ['processingplan', static::GUID1]],
            Type::PROCESSINGPLANMATERIAL => ['materials', Segment::MATERIALS, MaterialsSegment::class, ['processingplan', static::GUID1]],
            Type::PROCESSINGPLANRESULT => ['products', Segment::PRODUCTS, ProductsSegment::class, ['processingplan', static::GUID1]],
            Type::PROCESSINGPROCESS => ['processingprocess', Segment::PROCESSINGPROCESS, ProcessingProcessSegment::class],
            Type::PRODUCT => ['product', Segment::PRODUCT, ProductSegment::class],
            Type::RETAILSTORE => ['retailstore', Segment::RETAILSTORE, RetailStoreSegment::class],
            Type::SERVICE => ['service', Segment::SERVICE, ServiceSegment::class],
            Type::FILES => ['files', Segment::FILES, FilesSegment::class, ['counterparty', static::GUID1]],
            Type::EMBEDDEDTEMPLATE => ['embeddedtemplate', Segment::EMBEDDEDTEMPLATE, EmbeddedTemplateSegment::class, ['counterparty', 'metadata']],
            Type::CUSTOMTEMPLATE => ['customtemplate', Segment::CUSTOMTEMPLATE, CustomTemplateSegment::class, ['counterparty', 'metadata']],
            Type::ORGANIZATION => ['organization', Segment::ORGANIZATION, OrganizationSegment::class],
            Type::ACCOUNT => ['accounts', Segment::ACCOUNTS, AccountsSegment::class, ['organization', static::GUID1]],
            Type::PROCESSINGSTAGE => ['processingstage', Segment::PROCESSINGSTAGE, ProcessingStageSegment::class],
            Type::RETAILDRAWERCASHIN => ['retaildrawercashin', Segment::RETAILDRAWERCASHIN, RetailDrawerCashInSegment::class],
            Type::INTERNALORDER => ['internalorder', Segment::INTERNALORDER, InternalOrderSegment::class],
            Type::SALESRETURN => ['salesreturn', Segment::SALESRETURN, SalesReturnSegment::class],
            Type::PURCHASERETURN => ['purchasereturn', Segment::PURCHASERETURN, PurchaseReturnSegment::class],
            Type::PREPAYMENTRETURN => ['prepaymentreturn', Segment::PREPAYMENTRETURN, PrepaymentReturnSegment::class],
            Type::PAYMENTIN => ['paymentin', Segment::PAYMENTIN, PaymentInSegment::class],
            Type::COMMISSIONREPORTOUT => ['commissionreportout', Segment::COMMISSIONREPORTOUT, CommissionReportOutSegment::class],
            Type::RETAILDRAWERCASHOUT => ['retaildrawercashout', Segment::RETAILDRAWERCASHOUT, RetailDrawerCashOutSegment::class],
            Type::PROCESSINGORDER => ['processingorder', Segment::PROCESSINGORDER, ProcessingOrderSegment::class],
            Type::CUSTOMERORDER => ['customerorder', Segment::CUSTOMERORDER, CustomerOrderSegment::class],
            Type::PURCHASEORDER => ['purchaseorder', Segment::PURCHASEORDER, PurchaseOrderSegment::class],
            Type::INVENTORY => ['inventory', Segment::INVENTORY, InventorySegment::class],
            Type::PAYMENTOUT => ['paymentout', Segment::PAYMENTOUT, PaymentOutSegment::class],
            Type::COUNTERPARTYADJUSTMENT => ['counterpartyadjustment', Segment::COUNTERPARTYADJUSTMENT, CounterpartyAdjustmentSegment::class],
            Type::ENTER => ['enter', Segment::ENTER, EnterSegment::class],
            Type::DEMAND => ['demand', Segment::DEMAND, DemandSegment::class],
            Type::MOVE => ['move', Segment::MOVE, MoveSegment::class],
            Type::RETURNTOCOMMISSIONERPOSITION => ['returntocommissionerpositions', Segment::RETURNTOCOMMISSIONERPOSITIONS, ReturnToCommissionerPositionsSegment::class, ['commissionreportin', 'ea05e0c9-8667-11e7-8a7f-40d000000060']],
            Type::COMMISSIONREPORTIN => ['commissionreportin', Segment::COMMISSIONREPORTIN, CommissionReportInSegment::class],
            Type::PRICELIST => ['pricelist', Segment::PRICELIST, PriceListSegment::class],
            Type::PREPAYMENT => ['prepayment', Segment::PREPAYMENT, PrepaymentSegment::class],
            Type::SUPPLY => ['supply', Segment::SUPPLY, SupplySegment::class],
            Type::CASHIN => ['cashin', Segment::CASHIN, CashInSegment::class],
            Type::CASHOUT => ['cashout', Segment::CASHOUT, CashOutSegment::class],
            Type::RETAILDEMAND => ['retaildemand', Segment::RETAILDEMAND, RetailDemandSegment::class],
            Type::RETAILSHIFT => ['retailshift', Segment::RETAILSHIFT, RetailShiftSegment::class],
            Type::RETAILSALESRETURN => ['retailsalesreturn', Segment::RETAILSALESRETURN, RetailSalesReturnSegment::class],
            Type::LOSS => ['loss', Segment::LOSS, LossSegment::class],
            Type::INVOICEOUT => ['invoiceout', Segment::INVOICEOUT, InvoiceOutSegment::class],
        ];
    }
}
