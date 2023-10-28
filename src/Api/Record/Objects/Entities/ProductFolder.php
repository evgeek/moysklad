<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductFolderCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Группа товаров
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-gruppa-towarow
 *
 * @implements AbstractConcreteObject<ProductFolderCollection>
 */
class ProductFolder extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PRODUCTFOLDER,
    ];
    public const TYPE = Type::PRODUCTFOLDER;
}
