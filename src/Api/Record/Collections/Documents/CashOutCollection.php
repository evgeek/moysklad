<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CashOut;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Расходных ордеров
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-rashodnyj-order
 *
 * @implements AbstractConcreteCollection<CashOut>
 */
class CashOutCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CASHOUT,
    ];
    public const TYPE = Type::CASHOUT;
}
