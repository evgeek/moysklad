<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\DemandCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Отгрузка
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-otgruzka
 *
 * @implements AbstractConcreteObject<DemandCollection>
 */
class Demand extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::DEMAND,
    ];
    public const TYPE = Type::DEMAND;
}
