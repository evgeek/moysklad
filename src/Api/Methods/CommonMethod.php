<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods;

use Evgeek\Moysklad\Api\Traits\Crud\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Methods\AttributesTrait;
use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodTrait;
use Evgeek\Moysklad\Api\Traits\Methods\MetadataTrait;
use Evgeek\Moysklad\Api\Traits\Methods\PositionedMethodByIdTrait;
use Evgeek\Moysklad\Api\Traits\Methods\PositionsTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Traits\Params\SearchTrait;
use Evgeek\Moysklad\Http\ApiClient;
use JetBrains\PhpStorm\Pure;
use SplQueue;

class CommonMethod extends AbstractMethod
{
    use GetTrait;
    use GetGeneratorTrait;
    use CreateTrait;
    use MassDeleteTrait;
    use ParamTrait;
    use LimitOffsetTrait;
    use FilterTrait;
    use SearchTrait;
    use OrderTrait;
    use ExpandTrait;
    use CommonMethodTrait;
    use PositionedMethodByIdTrait;
    use MetadataTrait;
    use PositionsTrait;
    use AttributesTrait;

    #[Pure]
    public function __construct(
        ApiClient $api,
        ?SplQueue $payloadList,
        protected readonly string $path,
    ) {
        parent::__construct($api, $payloadList ?? new SplQueue());
    }
}
