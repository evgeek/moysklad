<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CashIn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Приходных ордеров
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-prihodnyj-order
 *
 * @implements AbstractConcreteCollection<CashIn>
 */
class CashInCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CASHIN,
    ];
    public const TYPE = Type::CASHIN;
}
