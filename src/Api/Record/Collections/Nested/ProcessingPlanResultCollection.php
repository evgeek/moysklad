<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Collections\Traits\StateCrudCollectionTrait;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanResult;
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Продуктов Техкарты
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-produkty-tehkarty
 *
 * @implements AbstractNestedCollection<ProcessingPlanResult>
 */
class ProcessingPlanResultCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::PRODUCTS,
    ];
    public const TYPE = Type::PROCESSINGPLANRESULT;
}
