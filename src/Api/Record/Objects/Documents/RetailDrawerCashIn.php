<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDrawerCashInCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Внесение денег
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vnesenie-deneg
 *
 * @implements AbstractConcreteObject<RetailDrawerCashInCollection>
 */
class RetailDrawerCashIn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::RETAILDRAWERCASHIN,
    ];
    public const TYPE = Type::RETAILDRAWERCASHIN;
}
