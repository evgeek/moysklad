<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders;

use Evgeek\Moysklad\Http\ApiClient;
use RuntimeException;

abstract class BuilderCommon extends Builder
{
    public function __construct(
        ApiClient $api,
        array $prevPath,
        array $params,
        protected readonly string $segment
    ) {
        parent::__construct($api, $prevPath, $params);
    }

    protected function makeCurrentPath(): array
    {
        if (!$this->segment) {
            throw new RuntimeException('$this->segment variable cannot be empty');
        }

        return [...$this->prevPath, $this->segment];
    }
}
