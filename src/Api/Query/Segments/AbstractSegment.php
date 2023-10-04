<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Query\Traits\DebugTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\SearchTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MethodCommonTrait;

abstract class AbstractSegment extends AbstractBuilder
{
    use DebugTrait;
    use ExpandTrait;
    use FilterTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use MethodCommonTrait;
    use OrderTrait;
    use ParamTrait;
    use SearchTrait;
    use SendTrait;
}
