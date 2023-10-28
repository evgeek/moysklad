<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingPlan;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Техкарт
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta
 *
 * @implements AbstractConcreteCollection<ProcessingPlan>
 */
class ProcessingPlanCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PROCESSINGPLAN,
    ];
    public const TYPE = Type::PROCESSINGPLAN;
}
