<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\AccountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\FilesCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ReturnToCommissionerPositionCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Позиция возврата на склад комиссионера
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-poluchennyj-otchet-komissionera-pozicii-wozwrata-na-sklad-komissionera
 *
 * @implements AbstractNestedObject<ReturnToCommissionerPositionCollection>
 */
class ReturnToCommissionerPosition extends AbstractNestedObject
{
    public const PATH = [
        Segment::RETURNTOCOMMISSIONERPOSITIONS,
    ];
    public const TYPE = Type::RETURNTOCOMMISSIONERPOSITION;
}
