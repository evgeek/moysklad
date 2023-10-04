<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\NamedFilterCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Сохраненный фильтр
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sohranennye-fil-try
 *
 * @implements AbstractNestedObject<NamedFilterCollection>
 */
class NamedFilter extends AbstractNestedObject
{
    public const PATH = [
        Segment::NAMEDFILTER,
    ];
    public const TYPE = Type::NAMEDFILTER;
}
