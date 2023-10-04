<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Service;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Услуг
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-usluga
 *
 * @implements AbstractConcreteCollection<Service>
 */
class ServiceCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SERVICE,
    ];
    public const TYPE = Type::SERVICE;
}
