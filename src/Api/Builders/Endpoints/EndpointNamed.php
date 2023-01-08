<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Endpoints;

use Evgeek\Moysklad\Api\Traits\Builders\MethodCommonTrait;
use Evgeek\Moysklad\Http\ApiClient;
use SplQueue;

abstract class EndpointNamed extends Endpoint
{
    use MethodCommonTrait;

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
