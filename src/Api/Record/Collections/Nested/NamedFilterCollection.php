<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Nested\NamedFilter;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Сохраненных фильтров
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sohranennye-fil-try
 *
 * @implements AbstractNestedCollection<NamedFilter>
 */
class NamedFilterCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::NAMEDFILTER,
    ];
    public const TYPE = Type::NAMEDFILTER;
}
