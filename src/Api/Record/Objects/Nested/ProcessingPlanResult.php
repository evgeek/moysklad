<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanResultCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\StateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Traits\StateCrudCollectionTrait;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Продукт Техкарты
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-produkty-tehkarty
 *
 * @implements AbstractNestedObject<ProcessingPlanResultCollection>
 */
class ProcessingPlanResult extends AbstractNestedObject
{
    public const PATH = [
        Segment::PRODUCTS,
    ];
    public const TYPE = Type::PROCESSINGPLANRESULT;
}
