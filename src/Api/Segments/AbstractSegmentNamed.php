<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments;

use Evgeek\Moysklad\Api\AbstractBuilder;
use InvalidArgumentException;
use RuntimeException;

abstract class AbstractSegmentNamed extends AbstractBuilder
{
    protected const SEGMENT = '';

    protected function makeCurrentPath(): array
    {
        if (!static::SEGMENT) {
            throw new InvalidArgumentException('SEGMENT constant cannot be empty');
        }

        return [...$this->prevPath, static::SEGMENT];
    }
}
