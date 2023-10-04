<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\TaskCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Задача
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-zadacha
 *
 * @implements AbstractConcreteObject<TaskCollection>
 */
class Task extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::TASK,
    ];
    public const TYPE = Type::TASK;
}
