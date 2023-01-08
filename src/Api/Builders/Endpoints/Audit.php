<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Endpoints;

use Evgeek\Moysklad\Api\Traits\Crud\DebugTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\SendTrait;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;

class Audit extends EndpointNamed
{
    use ByIdCommonTrait;
    use DebugTrait;
    use FilterTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use ParamTrait;
    use SendTrait;

    protected const PATH = 'audit';
}
