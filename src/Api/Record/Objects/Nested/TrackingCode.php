<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\TrackingCodeCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Код маркировки
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kody-markirowki
 *
 * @implements AbstractNestedObject<TrackingCodeCollection>
 */
class TrackingCode extends AbstractNestedObject
{
    public const PATH = [
        Segment::TRACKINGCODES,
    ];
    public const TYPE = Type::TRACKINGCODE;
}
