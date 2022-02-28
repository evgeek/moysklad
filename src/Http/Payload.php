<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use Evgeek\Moysklad\Enums\HttpMethod;

class Payload
{
    public function __construct(
        public readonly ?HttpMethod $method,
        public readonly string $path,
        public readonly array $params,
        public readonly string|array|object|null $body,
    )
    {
    }
}