<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\FactureIn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Счетов-фактур полученных
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-faktura-poluchennyj
 *
 * @implements AbstractConcreteCollection<FactureIn>
 */
class FactureInCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::FACTUREIN,
    ];
    public const TYPE = Type::FACTUREIN;
}
