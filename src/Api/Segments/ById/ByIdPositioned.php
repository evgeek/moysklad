<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\ById;

use Evgeek\Moysklad\Api\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Api\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Segments\PositionsTrait;

class ByIdPositioned extends AbstractById
{
    use DeleteTrait;
    use ExpandTrait;
    use PositionsTrait;
    use UpdateTrait;
}
