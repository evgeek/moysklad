<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\Collections\AssortmentCollection;
use Evgeek\Moysklad\Dictionaries\Endpoint;
use Evgeek\Moysklad\Dictionaries\Entity;

/**
 * Ассортимент
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-assortiment
 *
 * @implements AbstractConcreteObject<AssortmentCollection>
 */
class Assortment extends AbstractConcreteObject
{
    public const PATH = [
        Endpoint::ENTITY,
        Entity::ASSORTMENT,
    ];
    public const TYPE = Entity::ASSORTMENT;
}
