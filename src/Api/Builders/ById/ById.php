<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\ById;

use Evgeek\Moysklad\Api\Builders\BuilderCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Traits\Builders\MethodCommonTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;

abstract class ById extends BuilderCommon
{
    use ByIdCommonTrait;
    use GetTrait;
    use MethodCommonTrait;
    use ParamTrait;
    use SendTrait;
}
