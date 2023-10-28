<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDrawerCashOutCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Выплата денег
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vyplata-deneg
 *
 * @implements AbstractConcreteObject<RetailDrawerCashOutCollection>
 */
class RetailDrawerCashOut extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::RETAILDRAWERCASHOUT,
    ];
    public const TYPE = Type::RETAILDRAWERCASHOUT;
}
