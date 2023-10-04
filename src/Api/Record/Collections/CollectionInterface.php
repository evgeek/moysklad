<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections;

use Evgeek\Moysklad\Api\Record\AbstractUnknownRecord;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaCollection;
use Evgeek\Moysklad\Api\Record\Collections\Traits\CrudCollectionTrait;
use Evgeek\Moysklad\Api\Record\Collections\Traits\FillMetaCollectionTrait;
use Evgeek\Moysklad\Api\Record\Collections\Traits\IterateCollectionTrait;
use Evgeek\Moysklad\Api\Record\Collections\Traits\IteratorTrait;
use Evgeek\Moysklad\Api\Record\Collections\Traits\ParamsCollectionTrait;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Iterator;
use stdClass;

interface CollectionInterface
{
}
