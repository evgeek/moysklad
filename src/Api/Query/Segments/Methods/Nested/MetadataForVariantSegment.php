<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Nested;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\AttributesTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\CharacteristicsTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\StatesTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class MetadataForVariantSegment extends MetadataSegment
{
    use CharacteristicsTrait;
}
