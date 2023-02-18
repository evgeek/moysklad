<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Endpoints;

use Evgeek\Moysklad\Api\Segments\SegmentCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Traits\Segments\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;

class EndpointCommon extends SegmentCommon
{
    use ByIdCommonTrait;
    use FilterTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use MethodCommonTrait;
    use ParamTrait;
    use SendTrait;
}
