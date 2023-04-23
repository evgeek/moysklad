<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\Objects\Customerorder;
use Evgeek\Moysklad\Dictionaries\Endpoint;
use Evgeek\Moysklad\Dictionaries\Entity;

/**
 * Коллекция заказов покупателя
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
 *
 * @implements AbstractConcreteCollection<Customerorder>
 */
class CustomerorderCollection extends AbstractConcreteCollection
{
    public const PATH = [
        Endpoint::ENTITY,
        Entity::CUSTOMERORDER,
    ];
    public const TYPE = Entity::CUSTOMERORDER;
}
