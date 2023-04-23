<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\ApiObjects\AutocompleteHelpers\MetaCollection;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\CrudCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\FillMetaCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\IterateCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\IteratorTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\ParamsCollectionTrait;
use Iterator;
use stdClass;

/**
 * @template T
 *
 * @property stdClass       $context
 * @property MetaCollection $meta
 * @property T[]            $rows
 */
abstract class AbstractConcreteCollection extends AbstractConcreteApiObject implements Iterator
{
    use CrudCollectionTrait;
    use FillMetaCollectionTrait;
    use IterateCollectionTrait;
    use IteratorTrait;
    use ParamsCollectionTrait;
}
