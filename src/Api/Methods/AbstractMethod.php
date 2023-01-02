<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods;

use Evgeek\Moysklad\Api\Traits\Crud\DebugTrait;
use Evgeek\Moysklad\Api\Traits\Crud\SendTrait;

abstract class AbstractMethod extends AbstractMethods
{
    use DebugTrait;
    use SendTrait;
}
