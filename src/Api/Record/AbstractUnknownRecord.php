<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record;

use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;

abstract class AbstractUnknownRecord extends AbstractRecord
{
    public function __construct(MoySklad $ms, array $path, string $type, mixed $content = [])
    {
        if (!$path || !$type) {
            throw new InvalidArgumentException('path and type cannot be empty');
        }

        parent::__construct($ms, $content);

        $this->fillMeta($path, $type);
    }

    abstract protected function fillMeta(array $path, string $type): void;
}
