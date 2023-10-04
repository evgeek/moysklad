<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Traits\Segments\PositionsTrait;

class ByIdWithPositionsSegment extends AbstractByIdSegment
{
    use PositionsTrait;
}
