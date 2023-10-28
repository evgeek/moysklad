<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDemandCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Розничная продажа
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnaq-prodazha
 *
 * @implements AbstractConcreteObject<RetailDemandCollection>
 */
class RetailDemand extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::RETAILDEMAND,
    ];
    public const TYPE = Type::RETAILDEMAND;
}
