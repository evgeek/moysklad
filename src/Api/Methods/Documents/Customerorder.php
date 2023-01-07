<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Documents;

use Evgeek\Moysklad\Api\Methods\MethodNamed;
use Evgeek\Moysklad\Api\Traits\Crud\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Methods\MetadataTrait;
use Evgeek\Moysklad\Api\Traits\Methods\PositionedMethodByIdTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Traits\Params\SearchTrait;

class Customerorder extends MethodNamed
{
    use CreateTrait;
    use ExpandTrait;
    use FilterTrait;
    use GetGeneratorTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use MassDeleteTrait;
    use MetadataTrait;
    use OrderTrait;
    use PositionedMethodByIdTrait;
    use SearchTrait;

    protected const PATH = 'customerorder';
}
