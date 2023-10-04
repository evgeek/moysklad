<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods;

use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassCreateUpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\AttributesTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdWithPositionsTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\NamedFilterTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\PositionsTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\StatesTrait;

class MethodCommonSegment extends AbstractCommonSegment
{
    use AttributesTrait;
    use ByIdWithPositionsTrait;
    use CreateTrait;
    use DeleteTrait;
    use GetGeneratorTrait;
    use MassCreateUpdateTrait;
    use MassDeleteTrait;
    use MetadataTrait;
    use PositionsTrait;
    use UpdateTrait;
    use NamedFilterTrait;
    use StatesTrait;
}
