<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Methods;

use Evgeek\Moysklad\Api\Segments\SegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;

abstract class MethodNamed extends SegmentNamed
{
    use MethodCommonTrait;
    use ParamTrait;
    use SendTrait;
}
