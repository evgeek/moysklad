<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects;

use Evgeek\Moysklad\ApiObjects\Meta\AbstractMeta;
use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;

abstract class AbstractUnknownApiObject extends AbstractApiObject
{
    public function __construct(MoySklad $ms, array $path, protected readonly string $type, mixed $content = [])
    {
        if (!$path || !$this->type) {
            throw new InvalidArgumentException('path and type cannot be empty');
        }

        parent::__construct($ms, $content);

        $this->fillMeta($path);
    }

    abstract protected function convertMetaToObject(mixed $meta): AbstractMeta;

    protected function fillMeta(array $path): void
    {
        $meta = $this->meta ?? null;
        if (is_a($meta, AbstractMeta::class)) {
            return;
        }

        $id = $this->id ?? null;
        if ($id !== null && $path[count($path) - 1] !== $id) {
            $path[] = $id;
        }

        $meta = $meta ?? $this->ms->meta()->create($path, $this->type);

        $this->meta = $this->convertMetaToObject($meta);
    }
}
