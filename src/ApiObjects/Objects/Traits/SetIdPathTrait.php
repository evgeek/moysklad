<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\Services\Url;
use Evgeek\Moysklad\Tools\Guid;

trait SetIdPathTrait
{
    public function __set(string $name, mixed $value)
    {
        if ($name === 'id') {
            $this->setIdToPathAndMetaHref($value);
        }

        $this->{$name} = $value;
    }

    protected function hydrate(mixed $content): void
    {
        parent::hydrate($content);

        $this->setIdToPathAndMetaHref($this->id ?? null);
    }

    protected function setIdToPathAndMetaHref(?string $id): void
    {
        $href = $this->meta->href ?? null;
        if (!$href) {
            return;
        }

        [$path, $params] = Url::parsePathAndParams($href);
        $lastSegment = $path[count($path) - 1];
        $idHref = Guid::extractFirst($lastSegment) === null ? null : $lastSegment;

        $id = $id ?? $idHref;
        $lastSegment = $path[count($path) - 1];
        if ($lastSegment !== $id) {
            $path[] = $id;
            $this->meta->href = Url::makeFromPathAndParams($path, $params);
        }
    }
}
