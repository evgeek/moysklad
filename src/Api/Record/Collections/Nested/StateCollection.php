<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Collections\Traits\StateCrudCollectionTrait;
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Статусов документов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-statusy-dokumentow
 *
 * @implements AbstractNestedCollection<State>
 */
class StateCollection extends AbstractNestedCollection
{
    use StateCrudCollectionTrait;

    public const PATH = [
        Segment::METADATA,
        Segment::STATES,
    ];
    public const TYPE = Type::STATE;
}
