<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods;

use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Http\ApiClient;
use SplQueue;

abstract class MethodNamed extends Method
{
    use CommonMethodTrait;
    use ParamTrait;

    protected const PATH = '';
    protected readonly string $path;

    public function __construct(
        ApiClient $api,
        ?SplQueue $payloadList,
    ) {
        parent::__construct($api, $payloadList ?? new SplQueue());

        $this->path = static::PATH;
    }
}
