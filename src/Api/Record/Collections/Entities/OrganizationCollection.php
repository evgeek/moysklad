<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Organization;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Юрлиц
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico
 *
 * @implements AbstractConcreteCollection<Organization>
 */
class OrganizationCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::ORGANIZATION,
    ];
    public const TYPE = Type::ORGANIZATION;
}
