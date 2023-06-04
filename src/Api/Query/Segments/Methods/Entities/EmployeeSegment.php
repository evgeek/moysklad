<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodSegmentNamed;
use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassCreateUpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\SearchTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataTrait;
use Evgeek\Moysklad\Dictionaries\Entity;

class EmployeeSegment extends AbstractMethodSegmentNamed
{
    use ByIdCommonTrait;
    use CreateTrait;
    use ExpandTrait;
    use FilterTrait;
    use GetGeneratorTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use MassCreateUpdateTrait;
    use MassDeleteTrait;
    use MetadataTrait;
    use OrderTrait;
    use SearchTrait;

    public const SEGMENT = Entity::EMPLOYEE;
}
