<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AbstractUnknownApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\CrudCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\FillMetaCollectionTrait;

class UnknownCollection extends AbstractUnknownApiObject
{
    use CrudCollectionTrait;
    use FillMetaCollectionTrait;
}
