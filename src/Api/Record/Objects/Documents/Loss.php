<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\LossCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Списание
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-spisanie
 *
 * @implements AbstractConcreteObject<LossCollection>
 */
class Loss extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::LOSS,
    ];
    public const TYPE = Type::LOSS;
}
