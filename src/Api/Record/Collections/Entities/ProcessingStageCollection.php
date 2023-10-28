<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingStage;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Этапов производства
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jetap-proizwodstwa
 *
 * @implements AbstractConcreteCollection<ProcessingStage>
 */
class ProcessingStageCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PROCESSINGSTAGE,
    ];
    public const TYPE = Type::PROCESSINGSTAGE;
}
