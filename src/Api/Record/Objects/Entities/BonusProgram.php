<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\BonusProgramCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Бонусная программа
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-programma
 *
 * @implements AbstractConcreteObject<BonusProgramCollection>
 */
class BonusProgram extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::BONUSPROGRAM,
    ];
    public const TYPE = Type::BONUSPROGRAM;
}
