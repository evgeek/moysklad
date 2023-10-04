<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Task;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Задач
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-zadacha
 *
 * @implements AbstractConcreteCollection<Task>
 */
class TaskCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::TASK,
    ];
    public const TYPE = Type::TASK;
}
