<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\PositionsTrait;

class ByIdSegmentPositioned extends AbstractByIdSegment
{
    use DeleteTrait;
    use ExpandTrait;
    use PositionsTrait;
    use UpdateTrait;
}
