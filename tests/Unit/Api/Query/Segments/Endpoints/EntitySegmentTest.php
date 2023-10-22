<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\Endpoints\EntitySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CustomerOrderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\InternalOrderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PurchaseReturnSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailDrawerCashInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\SalesReturnSegment;
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
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StagesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StatesSegment;
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
            Type::ASSORTMENT => ['assortment', AssortmentSegment::class],
            Type::BONUSTRANSACTION => ['bonustransaction', BonusTransactionSegment::class],
            Type::BONUSPROGRAM => ['bonusprogram', BonusProgramSegment::class],
            Type::CURRENCY => ['currency', CurrencySegment::class],
            Type::WEBHOOK => ['webhook', WebhookSegment::class],
            Type::WEBHOOKSTOCK => ['webhookstock', WebhookStockSegment::class],
            Type::PRODUCTFOLDER => ['productfolder', ProductFolderSegment::class],
            Type::CONTRACT => ['contract', ContractSegment::class],
            Type::UOM => ['uom', UomSegment::class],
            Type::TASK => ['task', TaskSegment::class],
            Type::IMAGE => ['images', ImagesSegment::class, ['bundle', static::GUID1]],
            Type::SALESCHANNEL => ['saleschannel', SalesChannelSegment::class],
            Type::CASHIER => ['cashiers', CashiersSegment::class, ['retailstore', static::GUID1]],
//            Type::TRACKINGCODE => ['trackingCodes', TrackingCodesSegment::class, ['supply', 'ea05e0c9-8667-11e7-8a7f-40d000000060', 'positions', '161d25a8-1477-11ec-ac18-000b00000002']],
            Type::BUNDLE => ['bundle', BundleSegment::class],
            Type::COUNTERPARTY => ['counterparty', CounterpartySegment::class],
            Type::VARIANT => ['variant', VariantSegment::class],
            Type::GROUP => ['group', GroupSegment::class],
            Type::CUSTOMROLE => ['role', RoleSegment::class],
            Type::CUSTOMENTITY => ['customentity', CustomEntitySegment::class],
            Type::PROJECT => ['project', ProjectSegment::class],
            Type::REGION => ['region', RegionSegment::class],
            Type::CONSIGNMENT => ['consignment', ConsignmentSegment::class],
            Type::DISCOUNT => ['discount', DiscountSegment::class],
            Type::ACCUMULATIONDISCOUNT => ['accumulationdiscount', AccumulationDiscountSegment::class],
            Type::PERSONALDISCOUNT => ['personaldiscount', PersonalDiscountSegment::class],
            Type::SPECIALPRICEDISCOUNT => ['specialpricediscount', SpecialPriceDiscountSegment::class],
            Type::STORE => ['store', StoreSegment::class],
            Type::EMPLOYEE => ['employee', EmployeeSegment::class],
            Type::NAMEDFILTER => ['namedfilter', NamedFilterSegment::class, ['product']],
            Type::TAXRATE => ['taxrate', TaxRateSegment::class],
            Type::STATE => ['states', StatesSegment::class, ['counterparty', 'metadata']],
            Type::EXPENSEITEM => ['expenseitem', ExpenseItemSegment::class],
            Type::COUNTRY => ['country', CountrySegment::class],
            Type::PROCESSINGPLAN => ['processingplan', ProcessingPlanSegment::class],
            Type::PROCESSINGPLANSTAGES => ['stages', StagesSegment::class, ['processingplan', static::GUID1]],
            Type::PROCESSINGPLANMATERIAL => ['materials', MaterialsSegment::class, ['processingplan', static::GUID1]],
            Type::PROCESSINGPLANRESULT => ['products', ProductsSegment::class, ['processingplan', static::GUID1]],
            Type::PROCESSINGPROCESS => ['processingprocess', ProcessingProcessSegment::class],
            Type::PRODUCT => ['product', ProductSegment::class],
            Type::RETAILSTORE => ['retailstore', RetailStoreSegment::class],
            Type::SERVICE => ['service', ServiceSegment::class],
            Type::FILES => ['files', FilesSegment::class, ['counterparty', static::GUID1]],
            Type::EMBEDDEDTEMPLATE => ['embeddedtemplate', EmbeddedTemplateSegment::class, ['counterparty', 'metadata']],
            Type::CUSTOMTEMPLATE => ['customtemplate', CustomTemplateSegment::class, ['counterparty', 'metadata']],
            Type::ORGANIZATION => ['organization', OrganizationSegment::class],
            Type::ACCOUNT => ['accounts', AccountsSegment::class, ['organization', static::GUID1]],
            Type::PROCESSINGSTAGE => ['processingstage', ProcessingStageSegment::class],

            Type::RETAILDRAWERCASHIN => ['retaildrawercashin', RetailDrawerCashInSegment::class],
            Type::INTERNALORDER => ['internalorder', InternalOrderSegment::class],
            Type::SALESRETURN => ['salesreturn', SalesReturnSegment::class],
            Type::PURCHASERETURN => ['purchasereturn', PurchaseReturnSegment::class],

            Type::CUSTOMERORDER => ['customerorder', CustomerOrderSegment::class],
        ];
    }
}
