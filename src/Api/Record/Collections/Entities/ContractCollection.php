<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Contract;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Договоров
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-dogowor
 *
 * @implements AbstractConcreteCollection<Contract>
 */
class ContractCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CONTRACT,
    ];
    public const TYPE = Type::CONTRACT;
}
