<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Endpoints;

use Evgeek\Moysklad\Api\Traits\Methods\CommonMethodTrait;
use Evgeek\Moysklad\Http\ApiClient;
use SplQueue;

abstract class AbstractNamedEndpoint extends AbstractEndpoint
{
    use CommonMethodTrait;

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
