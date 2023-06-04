<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Traits;

use Evgeek\Moysklad\Formatters\StdClassFormat;

trait FillMetaObjectTrait
{
    protected function fillMeta(array $path): void
    {
        if ($this->meta) {
            return;
        }

        $id = $this->id ?? null;
        if ($id !== null && $path[array_key_last($path)] !== $id) {
            $path[] = $id;
        }

        $meta = $this->ms->meta()->create($path, $this->type);
        $formatter = $this->ms->getFormatter();

        $this->meta = (new StdClassFormat())->encode($formatter->decode($meta));
    }
}
