<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\FactureInCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Счет-фактура полученный
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-faktura-poluchennyj
 *
 * @implements AbstractConcreteObject<FactureInCollection>
 */
class FactureIn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::FACTUREIN,
    ];
    public const TYPE = Type::FACTUREIN;
}
