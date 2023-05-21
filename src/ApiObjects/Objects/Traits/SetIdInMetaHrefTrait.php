<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Services\Url;
use Evgeek\Moysklad\Tools\Guid;
use InvalidArgumentException;

trait SetIdInMetaHrefTrait
{
    public function __isset(string $name)
    {
        if ($name === 'meta') {
            return true;
        }

        return parent::__isset($name);
    }

    public function __set(string $name, mixed $value)
    {
        if ($value === null) {
            $this->__unset($name);

            return;
        }

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
            unset($this->contentContainer['meta']);
        }

        if ($name === 'meta') {
            throw new InvalidArgumentException('Meta property cannot be unset');
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

        if ($prevId === null) {
            $path[] = $id;
        } elseif ($id === null) {
            array_pop($path);
        } else {
            $path[array_key_last($path)] = $id;
        }

        $this->meta->href = Url::makeFromPathAndParams($path, $params);
    }
}
