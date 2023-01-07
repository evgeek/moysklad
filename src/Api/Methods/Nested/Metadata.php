<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Nested;

use Evgeek\Moysklad\Api\Methods\MethodNamed;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Methods\AttributesTrait;
use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodByIdTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;

class Metadata extends MethodNamed
{
    use AttributesTrait;
    use CommonMethodByIdTrait;
    use ExpandTrait;
    use GetTrait;

    protected const PATH = 'metadata';
}
