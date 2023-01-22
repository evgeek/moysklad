<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\ById;

use Evgeek\Moysklad\Api\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Api\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Api\Traits\Builders\PositionsTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;

class ByIdPositioned extends ById
{
    use DeleteTrait;
    use ExpandTrait;
    use PositionsTrait;
    use UpdateTrait;
}
