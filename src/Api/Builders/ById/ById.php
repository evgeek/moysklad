<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\ById;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Traits\Builders\MethodCommonTrait;
use Evgeek\Moysklad\Api\Traits\Crud\DebugTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\SendTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Http\ApiClient;
use SplQueue;

abstract class ById extends Builder
{
    use ByIdCommonTrait;
    use DebugTrait;
    use GetTrait;
    use MethodCommonTrait;
    use ParamTrait;
    use SendTrait;

    public function __construct(
        ApiClient $api,
        SplQueue $payloadList,
        protected readonly string $path,
    ) {
        parent::__construct($api, $payloadList);
    }
}
