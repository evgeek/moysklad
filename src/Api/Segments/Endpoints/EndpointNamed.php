<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Endpoints;

use Evgeek\Moysklad\Api\Segments\SegmentNamed;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;

abstract class EndpointNamed extends SegmentNamed
{
    use MethodCommonTrait;
}
