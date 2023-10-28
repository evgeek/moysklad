<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Nested;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassCreateUpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class TrackingCodesSegment extends AbstractMethodNamedSegment
{
    use GetGeneratorTrait;
    use MassCreateUpdateTrait;
    use MassDeleteTrait;

    public const SEGMENT = Segment::TRACKINGCODES;
}
