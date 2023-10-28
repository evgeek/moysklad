<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailSalesReturn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Розничных возвратов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnyj-wozwrat
 *
 * @implements AbstractConcreteCollection<RetailSalesReturn>
 */
class RetailSalesReturnCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::RETAILSALESRETURN,
    ];
    public const TYPE = Type::RETAILSALESRETURN;
}
