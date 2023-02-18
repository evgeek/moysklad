<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders;

use RuntimeException;

abstract class BuilderNamed extends Builder
{
    protected const SEGMENT = '';

    protected function makeCurrentPath(): array
    {
        if (!static::SEGMENT) {
            throw new RuntimeException('SEGMENT constant cannot be empty');
        }

        return [...$this->prevPath, static::SEGMENT];
    }
}
