<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Bundle;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Комплектов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-komplekt
 *
 * @implements AbstractConcreteCollection<Bundle>
 */
class BundleCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::BUNDLE,
    ];
    public const TYPE = Type::BUNDLE;
}
