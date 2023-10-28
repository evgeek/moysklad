<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\SupplyCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Приемка
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-priemka
 *
 * @implements AbstractConcreteObject<SupplyCollection>
 */
class Supply extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SUPPLY,
    ];
    public const TYPE = Type::SUPPLY;
}
