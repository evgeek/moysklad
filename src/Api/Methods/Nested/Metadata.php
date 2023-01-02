<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Nested;

use Evgeek\Moysklad\Api\Methods\AbstractNamedMethod;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Methods\AttributesTrait;
use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodByIdTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;

class Metadata extends AbstractNamedMethod
{
    use GetTrait;
    use ExpandTrait;
    use AttributesTrait;
    use CommonMethodByIdTrait;

    protected const PATH = 'metadata';
}
