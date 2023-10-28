<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\OrganizationCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Юрлицо
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico
 *
 * @implements AbstractConcreteObject<OrganizationCollection>
 */
class Organization extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::ORGANIZATION,
    ];
    public const TYPE = Type::ORGANIZATION;
}
