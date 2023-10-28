<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\InternalOrderCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Внутренний заказ
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vnutrennij-zakaz
 *
 * @implements AbstractConcreteObject<InternalOrderCollection>
 */
class InternalOrder extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::INTERNALORDER,
    ];
    public const TYPE = Type::INTERNALORDER;
}
