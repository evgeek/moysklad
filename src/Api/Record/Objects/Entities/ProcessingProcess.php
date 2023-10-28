<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingProcessCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Техпроцесс
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehprocess
 *
 * @implements AbstractConcreteObject<ProcessingProcessCollection>
 */
class ProcessingProcess extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PROCESSINGPROCESS,
    ];
    public const TYPE = Type::PROCESSINGPROCESS;
}
