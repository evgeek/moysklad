<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Supply;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Приемок
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-priemka
 *
 * @implements AbstractConcreteCollection<Supply>
 */
class SupplyCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SUPPLY,
    ];
    public const TYPE = Type::SUPPLY;
}
