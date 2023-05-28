<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MethodCommonTrait;

abstract class AbstractEndpointSegmentNamed extends AbstractSegmentNamed
{
    use MethodCommonTrait;
}
