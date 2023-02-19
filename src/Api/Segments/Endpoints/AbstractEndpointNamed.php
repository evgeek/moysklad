<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Endpoints;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;

abstract class AbstractEndpointNamed extends AbstractSegmentNamed
{
    use MethodCommonTrait;
}
