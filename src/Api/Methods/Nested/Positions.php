<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Nested;

use Evgeek\Moysklad\Api\Methods\AbstractNamedMethod;
use Evgeek\Moysklad\Api\Traits\Crud\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodByIdTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;

class Positions extends AbstractNamedMethod
{
    use GetTrait;
    use GetGeneratorTrait;
    use CreateTrait;
    use MassDeleteTrait;
    use ExpandTrait;
    use LimitOffsetTrait;
    use CommonMethodByIdTrait;

    protected const PATH = 'positions';
}