<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractUnknownApiObject;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\CrudObjectTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\FillMetaObjectTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\ParamsObjectTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetIdInMetaHrefTrait;

class UnknownObject extends AbstractUnknownApiObject
{
    use CrudObjectTrait;
    use FillMetaObjectTrait;
    use ParamsObjectTrait;
    use SetIdInMetaHrefTrait;
}
