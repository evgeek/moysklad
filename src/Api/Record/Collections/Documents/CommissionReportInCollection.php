<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CommissionReportIn;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Полученных отчетов комиссионера
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-poluchennyj-otchet-komissionera
 *
 * @implements AbstractConcreteCollection<CommissionReportIn>
 */
class CommissionReportInCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::COMMISSIONREPORTIN,
    ];
    public const TYPE = Type::COMMISSIONREPORTIN;
}
