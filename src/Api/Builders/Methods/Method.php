<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Methods;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Traits\Crud\DebugTrait;
use Evgeek\Moysklad\Api\Traits\Crud\SendTrait;

abstract class Method extends Builder
{
    use DebugTrait;
    use SendTrait;
}
