<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Endpoints;

use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Traits\Segments\ByIdCommonTrait;
use Evgeek\Moysklad\Dictionaries\Endpoint;

class NotificationSegment extends AbstractEndpointSegmentNamed
{
    use ByIdCommonTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use ParamTrait;
    use SendTrait;

    protected const SEGMENT = Endpoint::NOTIFICATION;
}
