<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Move;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Перемещений
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-peremeschenie
 *
 * @implements AbstractConcreteCollection<Move>
 */
class MoveCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::MOVE,
    ];
    public const TYPE = Type::MOVE;
}
