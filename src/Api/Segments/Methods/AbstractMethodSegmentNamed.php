<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Methods;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;

abstract class AbstractMethodSegmentNamed extends AbstractSegmentNamed
{
    use MethodCommonTrait;
    use ParamTrait;
    use SendTrait;
}
