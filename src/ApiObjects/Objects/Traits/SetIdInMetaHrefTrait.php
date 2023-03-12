<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\ApiObjects\Meta\MetaObject;
use Evgeek\Moysklad\Services\Url;
use Evgeek\Moysklad\Tools\Guid;
use InvalidArgumentException;

trait SetIdInMetaHrefTrait
{
    public function __get(string $name)
    {
        if ($name === 'meta') {
            return $this->hiddenMeta;
        }

        return parent::__get($name);
    }

    public function __isset(string $name)
    {
        if ($name === 'meta') {
            return true;
        }

        return parent::__isset($name);
    }

    public function __set(string $name, mixed $value)
    {
        if ($name === 'id') {
            if (!Guid::isGuid($value)) {
                throw new InvalidArgumentException('id must be a guid');
            }
            $this->setIdToMetaHref($value);
            $this->contentContainer['meta'] = $this->hiddenMeta;
        } elseif ($name === 'meta') {
            $this->hiddenMeta = new MetaObject($this->ms, $value);

            if (!($this->hiddenMeta->href ?? null) || !($this->hiddenMeta->type ?? null)) {
                throw new InvalidArgumentException('Meta must contain href and type');
            }

            [$path, $params] = Url::parsePathAndParams($this->hiddenMeta->href);
            if (Url::getId($this->hiddenMeta->href) || in_array('context', $path, true)) {
                $this->contentContainer['meta'] = $this->hiddenMeta;
            } else {
                unset($this->contentContainer['meta']);
            }

            return;
        }

        parent::__set($name, $value);
    }

    public function __unset(string $name)
    {
        if ($name === 'id') {
            $this->setIdToMetaHref(null);
            unset($this->contentContainer['meta']);
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
