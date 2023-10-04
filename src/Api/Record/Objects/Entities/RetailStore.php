<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\RetailStoreCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Точка продаж
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tochka-prodazh
 *
 * @implements AbstractConcreteObject<RetailStoreCollection>
 */
class RetailStore extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::RETAILSTORE,
    ];
    public const TYPE = Type::RETAILSTORE;
}
