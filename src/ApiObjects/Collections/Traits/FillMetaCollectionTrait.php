<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\ApiObjects\Meta\AbstractMeta;
use Evgeek\Moysklad\ApiObjects\Meta\MetaCollection;

trait FillMetaCollectionTrait
{
    protected function fillMeta(array $path): void
    {
        $meta = $this->meta ?? null;
        if (is_a($meta, AbstractMeta::class)) {
            return;
        }

        $meta = $meta ?? $this->ms->meta()->create($path, $this->type);

        $this->meta = new MetaCollection($this->ms, $meta);
    }
}
