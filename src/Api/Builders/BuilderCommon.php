<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders;

use Evgeek\Moysklad\Http\ApiClient;
use RuntimeException;

abstract class BuilderCommon extends Builder
{
    public function __construct(
        ApiClient $api,
        string $prevUrl,
        protected readonly string $path
    ) {
        parent::__construct($api, $prevUrl);
    }

    protected function makeCurrentUrl(): string
    {
        if (!$this->prevUrl) {
            throw new RuntimeException('$this->prevUrl variable cannot be empty');
        }
        if (!$this->path) {
            throw new RuntimeException('$this->path variable cannot be empty');
        }

        return $this->prevUrl . '/' . $this->path;
    }
}
