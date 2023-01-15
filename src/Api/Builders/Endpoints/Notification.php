<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Endpoints;

use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;

class Notification extends EndpointNamed
{
    use ByIdCommonTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use ParamTrait;
    use SendTrait;

    protected const NAME = 'notification';
}
