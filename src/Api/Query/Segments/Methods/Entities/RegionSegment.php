<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdCommonTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class RegionSegment extends AbstractEntitySegment
{
    use ByIdCommonTrait;

    public const SEGMENT = Segment::REGION;
}
