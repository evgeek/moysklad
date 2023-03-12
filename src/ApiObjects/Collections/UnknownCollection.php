<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AbstractUnknownApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\SetMetaCollectionTrait;

class UnknownCollection extends AbstractUnknownApiObject
{
    use SetMetaCollectionTrait;
}
