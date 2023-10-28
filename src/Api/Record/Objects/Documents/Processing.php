<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\ProcessingCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Техоперация
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-tehoperaciq
 *
 * @implements AbstractConcreteObject<ProcessingCollection>
 */
class Processing extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PROCESSING,
    ];
    public const TYPE = Type::PROCESSING;
}
