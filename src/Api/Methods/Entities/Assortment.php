<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Entities;

use Evgeek\Moysklad\Api\Methods\AbstractNamedMethod;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Traits\Params\SearchTrait;

class Assortment extends AbstractNamedMethod
{
    use GetTrait;
    use MassDeleteTrait;
    use ExpandTrait;
    use FilterTrait;
    use LimitOffsetTrait;
    use OrderTrait;
    use SearchTrait;

    protected const PATH = 'assortment';
}