<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingStageCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Этап производства
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jetap-proizwodstwa
 *
 * @implements AbstractConcreteObject<ProcessingStageCollection>
 */
class ProcessingStage extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PROCESSINGSTAGE,
    ];
    public const TYPE = Type::PROCESSINGSTAGE;
}
