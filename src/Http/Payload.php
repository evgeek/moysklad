<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use Evgeek\Moysklad\Enums\HttpMethod;

class Payload
{
    public function __construct(
        public readonly HttpMethod $method,
        public readonly array $path,
        public readonly array $params,
        public readonly mixed $body,
    ) {
    }
}
