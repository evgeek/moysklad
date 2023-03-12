<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\Services\Url;
use Evgeek\Moysklad\Tools\Guid;
use InvalidArgumentException;

trait SetIdInMetaHrefTrait
{
    public function __set(string $name, mixed $value)
    {
        if ($name === 'id') {
            if (!Guid::isGuid($value)) {
                throw new InvalidArgumentException('id must be a guid');
            }
            $this->setIdToMetaHref($value);
        }

        parent::__set($name, $value);
    }

    public function __unset(string $name)
    {
        if ($name === 'id') {
            $this->setIdToMetaHref(null);
        }

        parent::__unset($name);
    }

    protected function setIdToMetaHref(?string $id): void
    {
        $href = $this->meta->href ?? null;
        if (!$href) {
            return;
        }

        [$path, $params] = Url::parsePathAndParams($href);
        $prevId = Url::getId($href);

        if ($id === $prevId) {
            return;
        }

        if ($prevId === null) {
            $path[] = $id;
        } elseif ($id === null) {
            unset($path[count($path) - 1]);
        } else {
            $path[count($path) - 1] = $id;
        }

        $this->meta->href = Url::makeFromPathAndParams($path, $params);
    }
}
