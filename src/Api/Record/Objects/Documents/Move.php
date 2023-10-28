<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\MoveCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Перемещение
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-peremeschenie
 *
 * @implements AbstractConcreteObject<MoveCollection>
 */
class Move extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::MOVE,
    ];
    public const TYPE = Type::MOVE;
}
