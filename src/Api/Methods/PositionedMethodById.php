<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods;

use Evgeek\Moysklad\Api\Traits\Crud\DeleteTrait;
use Evgeek\Moysklad\Api\Traits\Crud\UpdateTrait;
use Evgeek\Moysklad\Api\Traits\Methods\PositionsTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;

class PositionedMethodById extends AbstractMethodById
{
    use DeleteTrait;
    use ExpandTrait;
    use PositionsTrait;
    use UpdateTrait;
}
