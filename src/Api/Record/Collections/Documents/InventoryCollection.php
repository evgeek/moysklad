<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Inventory;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Инвентаризаций
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-inwentarizaciq
 *
 * @implements AbstractConcreteCollection<Inventory>
 */
class InventoryCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::INVENTORY,
    ];
    public const TYPE = Type::INVENTORY;
}
