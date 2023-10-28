<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\ContractCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Договор
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-dogowor
 *
 * @implements AbstractConcreteObject<ContractCollection>
 */
class Contract extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CONTRACT,
    ];
    public const TYPE = Type::CONTRACT;
}
