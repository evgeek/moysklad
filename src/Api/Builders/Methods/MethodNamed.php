<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Methods;

use Evgeek\Moysklad\Api\Traits\Builders\MethodCommonTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Http\ApiClient;
use SplQueue;

abstract class MethodNamed extends Method
{
    use MethodCommonTrait;
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
