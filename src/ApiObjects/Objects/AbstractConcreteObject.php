<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\CrudObjectTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetIdInMetaHrefTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetMetaObjectTrait;

abstract class AbstractConcreteObject extends AbstractConcreteApiObject
{
    use CrudObjectTrait;
    use SetIdInMetaHrefTrait;
    use SetMetaObjectTrait;
}
