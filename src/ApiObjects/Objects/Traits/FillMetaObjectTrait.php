<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\ApiObjects\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use stdClass;

trait FillMetaObjectTrait
{
    /** @var MetaObject|null */
    protected ?stdClass $hiddenMeta = null;

    protected function fillMeta(array $path): void
    {
        $meta = $this->meta ?? null;

        $id = $this->id ?? null;
        if ($id !== null && $path[array_key_last($path)] !== $id) {
            $path[] = $id;
        }

        $meta = $meta ?? $this->ms->meta()->create($path, $this->type);
        $formatter = $this->ms->getApiClient()->getFormatter();

        $this->meta = (new StdClassFormat())->encode($formatter->decode($meta));
    }
}
