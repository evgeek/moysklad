<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments;

use InvalidArgumentException;

abstract class AbstractNamedSegment extends AbstractSegment
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
