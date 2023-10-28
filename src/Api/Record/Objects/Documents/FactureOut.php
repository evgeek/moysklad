<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\FactureOutCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Счет-фактура выданный
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-faktura-wydannyj
 *
 * @implements AbstractConcreteObject<FactureOutCollection>
 */
class FactureOut extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::FACTUREOUT,
    ];
    public const TYPE = Type::FACTUREOUT;
}
