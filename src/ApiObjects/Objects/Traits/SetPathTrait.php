<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\Services\Url;
use Evgeek\Moysklad\Tools\Guid;

trait SetPathTrait
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
        $params = [];
        $idHref = null;
        $href = $this->meta->href ?? null;
        if ($href) {
            [$path, $params] = Url::parsePathAndParams($href);
            $lastSegment = $path[count($path) - 1];
            $idHref = Guid::extractFirst($lastSegment) === null ? null : $lastSegment;
        }

        if (!$id && !$idHref) {
            return;
        }

        $id = $id ?? $idHref;
        $lastSegment = $this->path[count($this->path) - 1];
        if ($lastSegment !== $id) {
            $this->path[] = $id;
        }
        if ($id !== $idHref && isset($this->meta)) {
            $this->meta->href = Url::makeFromPathAndParams($this->path, $params);
        }
    }
}
