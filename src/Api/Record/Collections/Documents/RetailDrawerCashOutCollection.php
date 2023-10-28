<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashOut;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Выплат денег
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vyplata-deneg
 *
 * @implements AbstractConcreteCollection<RetailDrawerCashOut>
 */
class RetailDrawerCashOutCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::RETAILDRAWERCASHOUT,
    ];
    public const TYPE = Type::RETAILDRAWERCASHOUT;
}
