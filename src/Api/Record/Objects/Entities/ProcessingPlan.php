<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingPlanCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Техкарта
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta
 *
 * @implements AbstractConcreteObject<ProcessingPlanCollection>
 */
class ProcessingPlan extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PROCESSINGPLAN,
    ];
    public const TYPE = Type::PROCESSINGPLAN;
}
