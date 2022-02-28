<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Documents;

use Evgeek\Moysklad\Api\Methods\AbstractNamedMethod;
use Evgeek\Moysklad\Api\Traits\Crud\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Methods\MetadataTrait;
use Evgeek\Moysklad\Api\Traits\Methods\PositionedMethodByIdTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Traits\Params\SearchTrait;

class Customerorder extends AbstractNamedMethod
{
    use GetTrait;
    use CreateTrait;
    use MassDeleteTrait;
    use ExpandTrait;
    use FilterTrait;
    use LimitOffsetTrait;
    use OrderTrait;
    use SearchTrait;
    use MetadataTrait;
    use PositionedMethodByIdTrait;

    protected const PATH = 'customerorder';
}