<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\CrudObjectTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetIdInMetaHrefTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetMetaObjectTrait;
use Evgeek\Moysklad\Formatters\AbstractMultiDecoder;
use Evgeek\Moysklad\Services\Url;

abstract class AbstractConcreteObject extends AbstractConcreteApiObject
{
    use CrudObjectTrait;
    use SetIdInMetaHrefTrait;
    use SetMetaObjectTrait;

    public function toArray(): array
    {
        $container = $this->contentContainer;
        if ($this->meta && !Url::getId($this->meta->href)) {
            unset($container['meta']);

            return AbstractMultiDecoder::toArray($container);
        }

        return AbstractMultiDecoder::toArray($container);
    }
}
