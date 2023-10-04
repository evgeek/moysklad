<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Nested;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class SecuritySegment extends AbstractMethodNamedSegment
{
    use UpdateTrait;

    public const SEGMENT = Segment::SECURITY;
}
