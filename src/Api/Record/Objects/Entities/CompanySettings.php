<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Настройки компании
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-kompanii
 */
class CompanySettings extends AbstractEntity
{
    public const PATH = [
        Segment::CONTEXT,
        Segment::COMPANYSETTINGS,
    ];
    public const TYPE = Type::COMPANYSETTINGS;
}
