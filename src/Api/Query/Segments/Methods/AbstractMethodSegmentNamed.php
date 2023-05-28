<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods;

use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Query\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MethodCommonTrait;

abstract class AbstractMethodSegmentNamed extends AbstractSegmentNamed
{
    use MethodCommonTrait;
    use ParamTrait;
    use SendTrait;
}
