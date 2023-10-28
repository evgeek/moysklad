<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\CommissionReportOutCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Выданный отчет комиссионера
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vydannyj-otchet-komissionera
 *
 * @implements AbstractConcreteObject<CommissionReportOutCollection>
 */
class CommissionReportOut extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::COMMISSIONREPORTOUT,
    ];
    public const TYPE = Type::COMMISSIONREPORTOUT;
}
