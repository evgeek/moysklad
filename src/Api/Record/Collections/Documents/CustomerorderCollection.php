<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Customerorder;
use Evgeek\Moysklad\Dictionaries\Document;
use Evgeek\Moysklad\Dictionaries\Endpoint;

/**
 * Коллекция заказов покупателя.
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
 *
 * @implements AbstractConcreteCollection<Customerorder>
 */
class CustomerorderCollection extends AbstractConcreteCollection
{
    public const PATH = [
        Endpoint::ENTITY,
        Document::CUSTOMERORDER,
    ];
    public const TYPE = Document::CUSTOMERORDER;
}
