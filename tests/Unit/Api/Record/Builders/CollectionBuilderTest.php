<?php

namespace Evgeek\Tests\Unit\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\Builders\CollectionBuilder;
use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CashInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CashOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CommissionReportInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CommissionReportOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CounterpartyAdjustmentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\DemandCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\EnterCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\FactureInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\FactureOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\InternalOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\InventoryCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\InvoiceInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\InvoiceOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\LossCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\MoveCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PaymentInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PaymentOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PrepaymentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PrepaymentReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PriceListCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\ProcessingCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\ProcessingOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PurchaseOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\PurchaseReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDemandCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDrawerCashInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDrawerCashOutCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailSalesReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailShiftCollection;
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
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Moysklad\Formatters\RecordFormat;
use Evgeek\Moysklad\Formatters\RecordMapping;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Builders\AbstractBuilder
 * @covers \Evgeek\Moysklad\Api\Record\Builders\CollectionBuilder
 */
class CollectionBuilderTest extends RecordResolversTestCase
{
    private CollectionBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = new CollectionBuilder(new MoySklad(['token']));
    }

    public function testResolvingUnregisteredCollectionThrowsException(): void
    {
        $mapping = new RecordMapping([], []);
        $ms = new MoySklad(['token'], new RecordFormat($mapping));
        $builder = new CollectionBuilder($ms);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Collection type 'product' has no mapped class");

        $builder->product();
    }

    public function testUnknownMethod(): void
    {
        $path = ['endpoint', 'segment'];
        $type = 'unknown_type';
        $unknown = $this->builder->unknown($path, $type);

        $this->assertObjectResolvedWithExpectedMetaAndContent($unknown, UnknownCollection::class, $path, $type);
    }

    /**
     * @param class-string<AbstractConcreteCollection> $expectedSegment
     *
     * @dataProvider methodsWithCorrespondingObjectClass
     */
    public function testMethodReturnsCorrectClass(string $method, string $expectedSegment, bool $isNested = false): void
    {
        $expectedClass = $isNested ? AbstractNestedCollection::class : AbstractConcreteCollection::class;
        $collection = $isNested ?
            $this->builder->{$method}(['endpoint', 'segment'], static::CONTENT) :
            $this->builder->{$method}(static::CONTENT);

        $this->assertInstanceOf($expectedClass, $collection);
        $this->assertObjectResolvedWithExpectedMetaAndContent($collection, $expectedSegment);

        $path = $isNested ?
            ['endpoint', 'segment', ...$collection::PATH] :
            $collection::PATH;
        $expectedHref = Url::makeFromPathAndParams($path);
        $this->assertSame($expectedHref, $collection->meta->href);
    }

    public static function methodsWithCorrespondingObjectClass(): array
    {
        return [
            Type::ASSORTMENT => ['assortment', AssortmentCollection::class],
            Type::BONUSTRANSACTION => ['bonustransaction', BonusTransactionCollection::class],
            Type::BONUSPROGRAM => ['bonusprogram', BonusProgramCollection::class],
            Type::CURRENCY => ['currency', CurrencyCollection::class],
            Type::WEBHOOK => ['webhook', WebhookCollection::class],
            Type::WEBHOOKSTOCK => ['webhookstock', WebhookStockCollection::class],
            Type::PRODUCTFOLDER => ['productfolder', ProductFolderCollection::class],
            Type::CONTRACT => ['contract', ContractCollection::class],
            Type::UOM => ['uom', UomCollection::class],
            Type::TASK => ['task', TaskCollection::class],
            Type::IMAGE => ['image', ImageCollection::class, true],
            Type::SALESCHANNEL => ['saleschannel', SalesChannelCollection::class],
            Type::CASHIER => ['cashier', CashierCollection::class, true],
            Type::TRACKINGCODE => ['trackingcode', TrackingCodeCollection::class, true],
            Type::BUNDLE => ['bundle', BundleCollection::class],
            Type::COUNTERPARTY => ['counterparty', CounterpartyCollection::class],
            Type::VARIANT => ['variant', VariantCollection::class],
            Type::GROUP => ['group', GroupCollection::class],
            Type::CUSTOMROLE => ['role', CustomRoleCollection::class],
            Type::CUSTOMENTITY => ['customentity', CustomEntityCollection::class],
            Type::PROJECT => ['project', ProjectCollection::class],
            Type::REGION => ['region', RegionCollection::class],
            Type::CONSIGNMENT => ['consignment', ConsignmentCollection::class],
            Type::DISCOUNT => ['discount', DiscountCollection::class],
            Type::ACCUMULATIONDISCOUNT => ['accumulationdiscount', AccumulationDiscountCollection::class],
            Type::PERSONALDISCOUNT => ['personaldiscount', PersonalDiscountCollection::class],
            Type::SPECIALPRICEDISCOUNT => ['specialpricediscount', SpecialPriceDiscountCollection::class],
            Type::STORE => ['store', StoreCollection::class],
            Type::EMPLOYEE => ['employee', EmployeeCollection::class],
            Type::NAMEDFILTER => ['namedfilter', NamedFilterCollection::class, true],
            Type::TAXRATE => ['taxrate', TaxRateCollection::class],
            Type::STATE => ['state', StateCollection::class, true],
            Type::EXPENSEITEM => ['expenseitem', ExpenseItemCollection::class],
            Type::COUNTRY => ['country', CountryCollection::class],
            Type::PROCESSINGPLAN => ['processingplan', ProcessingPlanCollection::class],
            Type::PROCESSINGPLANSTAGES => ['processingplanstages', ProcessingPlanStagesCollection::class, true],
            Type::PROCESSINGPLANMATERIAL => ['processingplanmaterial', ProcessingPlanMaterialCollection::class, true],
            Type::PROCESSINGPLANRESULT => ['processingplanresult', ProcessingPlanResultCollection::class, true],
            Type::PROCESSINGPROCESS => ['processingprocess', ProcessingProcessCollection::class],
            Type::PRICETYPE => ['pricetype', PriceTypeCollection::class],
            Type::PRODUCT => ['product', ProductCollection::class],
            Type::RETAILSTORE => ['retailstore', RetailStoreCollection::class],
            Type::SERVICE => ['service', ServiceCollection::class],
            Type::FILES => ['files', FilesCollection::class, true],
            Type::ATTRIBUTEMETADATA => ['attributemetadata', AttributeMetadataCollection::class],
            Type::EMBEDDEDTEMPLATE => ['embeddedtemplate', EmbeddedTemplateCollection::class, true],
            Type::CUSTOMTEMPLATE => ['customtemplate', CustomTemplateCollection::class, true],
            Type::ORGANIZATION => ['organization', OrganizationCollection::class],
            Type::ACCOUNT => ['account', AccountCollection::class, true],
            Type::PROCESSINGSTAGE => ['processingstage', ProcessingStageCollection::class],
            Type::RETAILDRAWERCASHIN => ['retaildrawercashin', RetailDrawerCashInCollection::class],
            Type::INTERNALORDER => ['internalorder', InternalOrderCollection::class],
            Type::SALESRETURN => ['salesreturn', SalesReturnCollection::class],
            Type::PURCHASERETURN => ['purchasereturn', PurchaseReturnCollection::class],
            Type::PREPAYMENTRETURN => ['prepaymentreturn', PrepaymentReturnCollection::class],
            Type::PAYMENTIN => ['paymentin', PaymentInCollection::class],
            Type::COMMISSIONREPORTOUT => ['commissionreportout', CommissionReportOutCollection::class],
            Type::RETAILDRAWERCASHOUT => ['retaildrawercashout', RetailDrawerCashOutCollection::class],
            Type::PROCESSINGORDER => ['processingorder', ProcessingOrderCollection::class],
            Type::CUSTOMERORDER => ['customerorder', CustomerOrderCollection::class],
            Type::PURCHASEORDER => ['purchaseorder', PurchaseOrderCollection::class],
            Type::INVENTORY => ['inventory', InventoryCollection::class],
            Type::PAYMENTOUT => ['paymentout', PaymentOutCollection::class],
            Type::COUNTERPARTYADJUSTMENT => ['counterpartyadjustment', CounterpartyAdjustmentCollection::class],
            Type::ENTER => ['enter', EnterCollection::class],
            Type::DEMAND => ['demand', DemandCollection::class],
            Type::MOVE => ['move', MoveCollection::class],
            Type::RETURNTOCOMMISSIONERPOSITION => ['returntocommissionerposition', ReturnToCommissionerPositionCollection::class, true],
            Type::COMMISSIONREPORTIN => ['commissionreportin', CommissionReportInCollection::class],
            Type::PRICELIST => ['pricelist', PriceListCollection::class],
            Type::PREPAYMENT => ['prepayment', PrepaymentCollection::class],
            Type::SUPPLY => ['supply', SupplyCollection::class],
            Type::CASHIN => ['cashin', CashInCollection::class],
            Type::CASHOUT => ['cashout', CashOutCollection::class],
            Type::RETAILDEMAND => ['retaildemand', RetailDemandCollection::class],
            Type::RETAILSHIFT => ['retailshift', RetailShiftCollection::class],
            Type::RETAILSALESRETURN => ['retailsalesreturn', RetailSalesReturnCollection::class],
            Type::LOSS => ['loss', LossCollection::class],
            Type::INVOICEOUT => ['invoiceout', InvoiceOutCollection::class],
            Type::INVOICEIN => ['invoicein', InvoiceInCollection::class],
            Type::FACTUREOUT => ['factureout', FactureOutCollection::class],
            Type::FACTUREIN => ['facturein', FactureInCollection::class],
            Type::PROCESSING => ['processing', ProcessingCollection::class],
        ];
    }
}
