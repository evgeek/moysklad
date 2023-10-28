<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\CommissionReportInCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Полученный отчет комиссионера
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-poluchennyj-otchet-komissionera
 *
 * @implements AbstractConcreteObject<CommissionReportInCollection>
 */
class CommissionReportIn extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::COMMISSIONREPORTIN,
    ];
    public const TYPE = Type::COMMISSIONREPORTIN;
}
