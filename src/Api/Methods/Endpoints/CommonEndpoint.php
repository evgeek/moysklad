<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Endpoints;

use Evgeek\Moysklad\Api\Traits\Crud\DebugTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\SendTrait;
use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodByIdTrait;
use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Http\ApiClient;
use JetBrains\PhpStorm\Pure;
use SplQueue;

class CommonEndpoint extends AbstractEndpoint
{
    use SendTrait;
    use GetTrait;
    use DebugTrait;
    use ParamTrait;
    use FilterTrait;
    use LimitOffsetTrait;
    use CommonMethodTrait;
    use CommonMethodByIdTrait;

    #[Pure]
    public function __construct(
        ApiClient $api,
        ?SplQueue $payloadList,
        protected readonly string $path,
    )
    {
        parent::__construct($api, $payloadList ?? new SplQueue());
    }
}