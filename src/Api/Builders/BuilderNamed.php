<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders;

use RuntimeException;

abstract class BuilderNamed extends Builder
{
    protected const NAME = '';

    protected function makeCurrentPath(): array
    {
        if (!static::NAME) {
            throw new RuntimeException('NAME constant cannot be empty');
        }

        return [...$this->prevPath, static::NAME];
    }
}
