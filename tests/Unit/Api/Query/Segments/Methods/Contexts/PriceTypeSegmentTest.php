<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Methods\Contexts;

use Evgeek\Moysklad\Api\Query\Segments\Endpoints\EntitySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\CompanySettingsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\PriceTypeSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CustomerOrderSegment;
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
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\DefaultSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\EmbeddedTemplateSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\FilesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ImagesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\MaterialsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\NamedFilterSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ProductsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StagesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StatesSegment;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Tests\Unit\Api\Query\Segments\SegmentTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\PriceTypeSegment
 */
class PriceTypeSegmentTest extends SegmentTestCase
{
    protected string $builderClass = PriceTypeSegment::class;

    public static function methodsWithCorrespondingSegmentClass(): array
    {
        return [
            'default' => ['default', Segment::DEFAULT, DefaultSegment::class],
        ];
    }
}
