<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Objects;

use Evgeek\Moysklad\Api\Record\Collections\Entities\FilesCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\CashierCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ImageCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\NamedFilterCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanMaterialCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanResultCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanStagesCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\StateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\TrackingCodeCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Counterparty;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Files;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingPlan;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Cashier;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Image;
use Evgeek\Moysklad\Api\Record\Objects\Nested\NamedFilter;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanMaterial;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanResult;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanStages;
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Api\Record\Objects\Nested\TrackingCode;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Moysklad\MoySklad;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject
 */
class AbstractNestedObjectTest extends KnownObjectTestCase
{
    public static function classAndCollection(): array
    {
        $ms = new MoySklad(['']);

        return [
            Type::IMAGE => [Image::class, ImageCollection::class, Product::make($ms)],
            Type::CASHIER => [Cashier::class, CashierCollection::class, Product::class],
            Type::TRACKINGCODE => [TrackingCode::class, TrackingCodeCollection::class, ['entity', 'product']],
            Type::NAMEDFILTER => [NamedFilter::class, NamedFilterCollection::class, 'product'],
            Type::STATE => [State::class, StateCollection::class, 'counterparty'],
            Type::PROCESSINGPLANSTAGES => [ProcessingPlanStages::class, ProcessingPlanStagesCollection::class, ProcessingPlan::make($ms)],
            Type::PROCESSINGPLANMATERIAL => [ProcessingPlanMaterial::class, ProcessingPlanMaterialCollection::class, ProcessingPlan::make($ms)],
            Type::PROCESSINGPLANRESULT => [ProcessingPlanResult::class, ProcessingPlanResultCollection::class, ProcessingPlan::make($ms)],
            Type::FILES => [Files::class, FilesCollection::class, Counterparty::make($ms)],
        ];
    }
}
