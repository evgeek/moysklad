<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Endpoints;

use Evgeek\Moysklad\Api\Builders\BuilderNamed;
use Evgeek\Moysklad\Api\Traits\Builders\MethodCommonTrait;

abstract class EndpointNamed extends BuilderNamed
{
    use MethodCommonTrait;
}
