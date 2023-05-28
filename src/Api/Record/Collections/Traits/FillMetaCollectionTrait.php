<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Formatters\StdClassFormat;

trait FillMetaCollectionTrait
{
    protected function fillMeta(array $path): void
    {
        if ($this->meta) {
            return;
        }

        $meta = $this->ms->meta()->create($path, $this->type);
        $formatter = $this->ms->getFormatter();

        $this->meta = (new StdClassFormat())->encode($formatter->decode($meta));
    }
}
