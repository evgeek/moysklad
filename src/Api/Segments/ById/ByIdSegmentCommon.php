<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\ById;

use Evgeek\Moysklad\Api\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Api\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;

class ByIdSegmentCommon extends AbstractByIdSegment
{
    use DeleteTrait;
    use ExpandTrait;
    use UpdateTrait;
}
