<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Prepayment;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Предоплат
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-predoplata
 *
 * @implements AbstractConcreteCollection<Prepayment>
 */
class PrepaymentCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PREPAYMENT,
    ];
    public const TYPE = Type::PREPAYMENT;
}
