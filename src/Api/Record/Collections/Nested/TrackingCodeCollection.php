<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\TrackingcodeObject;
use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Кодов маркировки
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kody-markirowki
 *
 * @implements AbstractNestedCollection<TrackingcodeObject>
 */
class TrackingCodeCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::TRACKINGCODES,
    ];
    public const TYPE = Type::TRACKINGCODE;
}
