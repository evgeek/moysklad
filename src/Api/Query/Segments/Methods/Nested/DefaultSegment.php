<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Nested;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Dictionaries\Segment;

class DefaultSegment extends AbstractMethodNamedSegment
{
    public const SEGMENT = Segment::DEFAULT;
}
