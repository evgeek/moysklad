<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MethodCommonTrait;

abstract class AbstractByIdSegment extends AbstractSegmentCommon
{
    use ByIdCommonTrait;
    use GetTrait;
    use MethodCommonTrait;
    use ParamTrait;
    use SendTrait;
}
