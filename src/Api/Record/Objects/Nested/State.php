<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\StateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Traits\StateCrudCollectionTrait;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Статус документа
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-statusy-dokumentow
 *
 * @implements AbstractNestedObject<StateCollection>
 */
class State extends AbstractNestedObject
{
    public const PATH = [
        Segment::METADATA,
        Segment::STATES,
    ];
    public const TYPE = Type::STATE;
}
