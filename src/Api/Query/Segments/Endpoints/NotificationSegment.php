<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ByIdCommonTrait;
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
