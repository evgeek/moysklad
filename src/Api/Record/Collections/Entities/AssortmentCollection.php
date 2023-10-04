<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Bundle;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Consignment;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Service;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Variant;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Ассортиментов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-assortiment
 *
 * @implements AbstractConcreteCollection<Product>
 * @implements AbstractConcreteCollection<Service>
 * @implements AbstractConcreteCollection<Bundle>
 * @implements AbstractConcreteCollection<Consignment>
 * @implements AbstractConcreteCollection<Variant>
 */
class AssortmentCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::ASSORTMENT,
    ];
    public const TYPE = Type::ASSORTMENT;
}
