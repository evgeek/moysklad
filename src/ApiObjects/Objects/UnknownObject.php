<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractUnknownApiObject;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\CrudObjectTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetIdInMetaHrefTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetMetaObjectTrait;

class UnknownObject extends AbstractUnknownApiObject
{
    use CrudObjectTrait;
    use SetIdInMetaHrefTrait;
    use SetMetaObjectTrait;
}
