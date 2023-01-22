<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Methods;

use Evgeek\Moysklad\Api\Builders\BuilderNamed;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Traits\Builders\MethodCommonTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;

abstract class MethodNamed extends BuilderNamed
{
    use MethodCommonTrait;
    use ParamTrait;
    use SendTrait;
}
