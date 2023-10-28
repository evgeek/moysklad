<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ReturnToCommissionerPosition;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Позиций возврата на склад комиссионера
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-poluchennyj-otchet-komissionera-pozicii-wozwrata-na-sklad-komissionera
 *
 * @implements AbstractNestedCollection<ReturnToCommissionerPosition>
 */
class ReturnToCommissionerPositionCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::RETURNTOCOMMISSIONERPOSITIONS,
    ];
    public const TYPE = Type::RETURNTOCOMMISSIONERPOSITION;
}
