<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Traits;

use Evgeek\Moysklad\Formatters\StdClassFormat;

trait FillMetaObjectTrait
{
    protected function fillMeta(array $path, string $type): void
    {
        if ($this->meta !== null) {
            return;
        }

        $id = $this->id ?? null;
        if ($id !== null && $path[array_key_last($path)] !== $id) {
            $path[] = $id;
        }

        $meta = $this->ms->meta()->create($path, $type);
        $formatter = $this->ms->getFormatter();

        $this->meta = (new StdClassFormat())->encode($formatter->decode($meta));
    }
}
