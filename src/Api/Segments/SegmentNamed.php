<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments;

use Evgeek\Moysklad\Api\Builder;
use RuntimeException;

abstract class SegmentNamed extends Builder
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
