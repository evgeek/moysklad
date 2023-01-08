<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders;

use RuntimeException;

abstract class BuilderNamed extends Builder
{
    protected const PATH = '';

    protected function makeCurrentUrl(): string
    {
        if (!$this->prevUrl) {
            throw new RuntimeException('$this->prevUrl variable cannot be empty');
        }
        if (!static::PATH) {
            throw new RuntimeException('PATH constant cannot be empty');
        }

        return $this->prevUrl . '/' . static::PATH;
    }
}
