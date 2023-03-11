<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\ById;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Traits\Segments\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;

abstract class AbstractByIdSegment extends AbstractSegmentCommon
{
    use ByIdCommonTrait;
    use GetTrait;
    use MethodCommonTrait;
    use ParamTrait;
    use SendTrait;
}
