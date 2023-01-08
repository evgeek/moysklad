<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\ById;

use Evgeek\Moysklad\Api\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Api\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;

class ByIdCommon extends ById
{
    use DeleteTrait;
    use ExpandTrait;
    use UpdateTrait;
}
