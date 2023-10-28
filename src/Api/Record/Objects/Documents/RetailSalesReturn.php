<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailSalesReturnCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Розничный возврат
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnyj-wozwrat
 *
 * @implements AbstractConcreteObject<RetailSalesReturnCollection>
 */
class RetailSalesReturn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::RETAILSALESRETURN,
    ];
    public const TYPE = Type::RETAILSALESRETURN;
}
