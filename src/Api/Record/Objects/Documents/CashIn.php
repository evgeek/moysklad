<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\CashInCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Приходный ордер
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-prihodnyj-order
 *
 * @implements AbstractConcreteObject<CashInCollection>
 */
class CashIn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CASHIN,
    ];
    public const TYPE = Type::CASHIN;
}
