<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\SetMetaCollectionTrait;

abstract class AbstractConcreteCollection extends AbstractConcreteApiObject
{
    use SetMetaCollectionTrait;
}
