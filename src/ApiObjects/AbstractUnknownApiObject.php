<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects;

use Evgeek\Moysklad\ApiObjects\Meta\AbstractMeta;
use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;

abstract class AbstractUnknownApiObject extends AbstractApiObject
{
    public function __construct(MoySklad $ms, protected array $path, protected readonly string $type, mixed $content = [])
    {
        if (!$this->path || !$this->type) {
            throw new InvalidArgumentException('path and type cannot be empty');
        }

        parent::__construct($ms, $content);

        $this->fillMeta();
    }

    abstract protected function convertMetaToObject(mixed $meta): AbstractMeta;

    protected function fillMeta(): void
    {
        $meta = $this->meta ?? null;
        if (is_subclass_of($meta, AbstractMeta::class)) {
            return;
        }
        $meta = $meta ?? $this->ms->meta()->create($this->path, $this->type);

        $this->meta = $this->convertMetaToObject($meta);
    }
}
