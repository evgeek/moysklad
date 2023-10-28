<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailShift;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Розничных смен
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnaq-smena
 *
 * @implements AbstractConcreteCollection<RetailShift>
 */
class RetailShiftCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::RETAILSHIFT,
    ];
    public const TYPE = Type::RETAILSHIFT;
}
