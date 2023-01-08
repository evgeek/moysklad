<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use Evgeek\Moysklad\Enums\HttpMethod;
use stdClass;

class Payload
{
    public function __construct(
        public readonly HttpMethod $method,
        public readonly string $url,
        public readonly array $params,
        public readonly stdClass|array|string|null $body,
    ) {
    }
}
