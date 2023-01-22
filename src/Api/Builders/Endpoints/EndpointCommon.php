<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Endpoints;

use Evgeek\Moysklad\Api\Builders\BuilderCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Traits\Builders\MethodCommonTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;

class EndpointCommon extends BuilderCommon
{
    use ByIdCommonTrait;
    use FilterTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use MethodCommonTrait;
    use ParamTrait;
    use SendTrait;
}
