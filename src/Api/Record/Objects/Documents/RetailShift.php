<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailShiftCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Розничная смена
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnaq-smena
 *
 * @implements AbstractConcreteObject<RetailShiftCollection>
 */
class RetailShift extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::RETAILSHIFT,
    ];
    public const TYPE = Type::RETAILSHIFT;
}
