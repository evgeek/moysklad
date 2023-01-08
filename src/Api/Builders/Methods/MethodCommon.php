<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Methods;

use Evgeek\Moysklad\Api\Traits\Builders\AttributesTrait;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdPositionedTrait;
use Evgeek\Moysklad\Api\Traits\Builders\MetadataTrait;
use Evgeek\Moysklad\Api\Traits\Builders\MethodCommonTrait;
use Evgeek\Moysklad\Api\Traits\Builders\PositionsTrait;
use Evgeek\Moysklad\Api\Traits\Crud\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Traits\Params\SearchTrait;
use Evgeek\Moysklad\Http\ApiClient;
use SplQueue;

class MethodCommon extends Method
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

    public function __construct(
        ApiClient $api,
        ?SplQueue $payloadList,
        protected readonly string $path,
    ) {
        parent::__construct($api, $payloadList ?? new SplQueue());
    }
}
