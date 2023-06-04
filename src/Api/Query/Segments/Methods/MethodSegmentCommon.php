<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods;

use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\SearchTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\AttributesTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ByIdPositionedTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MethodCommonTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\PositionsTrait;

class MethodSegmentCommon extends AbstractSegmentCommon
{
    use AttributesTrait;
    use ByIdPositionedTrait;
    use CreateTrait;
    use ExpandTrait;
    use FilterTrait;
    use GetGeneratorTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use MassDeleteTrait;
    use MetadataTrait;
    use MethodCommonTrait;
    use OrderTrait;
    use ParamTrait;
    use PositionsTrait;
    use SearchTrait;
    use SendTrait;
}
