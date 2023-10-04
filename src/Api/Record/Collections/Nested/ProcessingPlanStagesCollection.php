<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Collections\Traits\StateCrudCollectionTrait;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanStages;
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Этапов Техкарты
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-jetapy-tehkarty
 *
 * @implements AbstractNestedCollection<ProcessingPlanStages>
 */
class ProcessingPlanStagesCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::STAGES,
    ];
    public const TYPE = Type::PROCESSINGPLANSTAGES;
}
