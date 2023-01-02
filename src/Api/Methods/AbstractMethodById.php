<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods;

use Evgeek\Moysklad\Api\Traits\Crud\DebugTrait;
use Evgeek\Moysklad\Api\Traits\Crud\GetTrait;
use Evgeek\Moysklad\Api\Traits\Crud\SendTrait;
use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodByIdTrait;
use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Http\ApiClient;
use JetBrains\PhpStorm\Pure;
use SplQueue;

abstract class AbstractMethodById extends AbstractMethods
{
    use CommonMethodByIdTrait;
    use CommonMethodTrait;
    use DebugTrait;
    use GetTrait;
    use ParamTrait;
    use SendTrait;

    #[Pure]
    public function __construct(
        ApiClient $api,
        SplQueue $payloadList,
        protected readonly string $path,
    ) {
        parent::__construct($api, $payloadList);
    }
}
