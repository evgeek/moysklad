<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdCommonTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class SpecialPriceDiscountSegment extends AbstractEntitySegment
{
    use ByIdCommonTrait;
    use CreateTrait;

    public const SEGMENT = Segment::SPECIALPRICEDISCOUNT;
}
