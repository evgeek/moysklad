<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\ApiObjects\Meta\AbstractMeta;
use Evgeek\Moysklad\ApiObjects\Meta\MetaObject;

trait FillMetaObjectTrait
{
    protected ?MetaObject $hiddenMeta = null;

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
        $this->meta = new MetaObject($this->ms, $meta);
    }
}
