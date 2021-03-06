<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Endpoints;

use Evgeek\Moysklad\Api\Traits\Crud\DebugTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\SendTrait;
use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodByIdTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;

class Audit extends AbstractNamedEndpoint
{
    use SendTrait;
    use GetTrait;
    use DebugTrait;
    use ParamTrait;
    use FilterTrait;
    use LimitOffsetTrait;
    use CommonMethodByIdTrait;

    protected const PATH = 'audit';
}