<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\CrudCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\FillMetaCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\IterateCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\ParamsCollectionTrait;

abstract class AbstractConcreteCollection extends AbstractConcreteApiObject
{
    use CrudCollectionTrait;
    use FillMetaCollectionTrait;
    use IterateCollectionTrait;
    use ParamsCollectionTrait;
}
