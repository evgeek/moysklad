<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Methods\Nested;

use Evgeek\Moysklad\Api\Builders\Methods\MethodNamed;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Builders\AttributesTrait;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;

class Metadata extends MethodNamed
{
    use AttributesTrait;
    use ByIdCommonTrait;
    use ExpandTrait;
    use GetTrait;

    protected const PATH = 'metadata';
}
