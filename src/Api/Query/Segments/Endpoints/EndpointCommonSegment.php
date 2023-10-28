<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdCommonTrait;

class EndpointCommonSegment extends AbstractCommonSegment
{
    use ByIdCommonTrait;
}
