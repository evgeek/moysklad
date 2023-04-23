<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AbstractUnknownApiObject;
use Evgeek\Moysklad\ApiObjects\AutocompleteHelpers\MetaCollection;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\CrudCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\FillMetaCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\IterateCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\ParamsCollectionTrait;
use Evgeek\Moysklad\ApiObjects\Objects\UnknownObject;
use stdClass;

/**
 * @property stdClass        $context
 * @property MetaCollection  $meta
 * @property UnknownObject[] $rows
 */
class UnknownCollection extends AbstractUnknownApiObject
{
    use CrudCollectionTrait;
    use FillMetaCollectionTrait;
    use IterateCollectionTrait;
    use ParamsCollectionTrait;
}
