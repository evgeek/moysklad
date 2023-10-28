<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\BonusProgram;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Бонусных программ
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-programma
 *
 * @implements AbstractConcreteCollection<BonusProgram>
 */
class BonusProgramCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::BONUSPROGRAM,
    ];
    public const TYPE = Type::BONUSPROGRAM;
}
