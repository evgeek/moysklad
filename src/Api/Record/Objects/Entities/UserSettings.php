<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Настройки пользователя
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-pol-zowatelq
 */
class UserSettings extends AbstractEntity
{
    public const PATH = [
        Segment::CONTEXT,
        Segment::USERSETTINGS,
    ];
    public const TYPE = Type::USERSETTINGS;
}
