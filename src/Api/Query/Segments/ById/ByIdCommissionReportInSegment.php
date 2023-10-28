<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ReturnToCommissionerPositionsSegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\PositionsTrait;

class ByIdCommissionReportInSegment extends AbstractByIdSegment
{
    use PositionsTrait;

    /**
     * Позиции возврата на склад комиссионера
     *
     * <code>
     * $cashiers = $ms->query()
     *   ->entity()
     *   ->commissionreportin()
     *   ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *   ->returntocommissionerpositions()
     *   ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kassir
     */
    public function returntocommissionerpositions(): ReturnToCommissionerPositionsSegment
    {
        return $this->resolveNamedBuilder(ReturnToCommissionerPositionsSegment::class);
    }
}
