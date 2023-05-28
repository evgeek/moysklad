<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections;

use Evgeek\Moysklad\Api\Record\AbstractConcreteRecord;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaCollection;
use Evgeek\Moysklad\Api\Record\Collections\Traits\CrudCollectionTrait;
use Evgeek\Moysklad\Api\Record\Collections\Traits\FillMetaCollectionTrait;
use Evgeek\Moysklad\Api\Record\Collections\Traits\IterateCollectionTrait;
use Evgeek\Moysklad\Api\Record\Collections\Traits\IteratorTrait;
use Evgeek\Moysklad\Api\Record\Collections\Traits\ParamsCollectionTrait;
use Iterator;
use stdClass;

/**
 * @template T
 *
 * @property stdClass       $context
 * @property MetaCollection $meta
 * @property T[]            $rows
 */
abstract class AbstractConcreteCollection extends AbstractConcreteRecord implements Iterator
{
    use CrudCollectionTrait;
    use FillMetaCollectionTrait;
    use IterateCollectionTrait;
    use IteratorTrait;
    use ParamsCollectionTrait;
}
