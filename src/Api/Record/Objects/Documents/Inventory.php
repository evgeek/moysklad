<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\InventoryCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Инвентаризация
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-inwentarizaciq
 *
 * @implements AbstractConcreteObject<InventoryCollection>
 */
class Inventory extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::INVENTORY,
    ];
    public const TYPE = Type::INVENTORY;
}
