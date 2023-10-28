<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingProcess;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Техпроцессов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehprocess
 *
 * @implements AbstractConcreteCollection<ProcessingProcess>
 */
class ProcessingProcessCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PROCESSINGPROCESS,
    ];
    public const TYPE = Type::PROCESSINGPROCESS;
}
