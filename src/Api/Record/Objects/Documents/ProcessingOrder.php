<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\ProcessingOrderCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Заказ на производство
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-na-proizwodstwo
 *
 * @implements AbstractConcreteObject<ProcessingOrderCollection>
 */
class ProcessingOrder extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PROCESSINGORDER,
    ];
    public const TYPE = Type::PROCESSINGORDER;
}
