<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CashiersSegment;

class ByIdRetailStoreSegment extends AbstractByIdSegment
{
    /**
     * Кассиры.
     *
     * <code>
     * $cashiers = $ms->query()
     *   ->entity()
     *   ->retailstore()
     *   ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *   ->cashiers()
     *   ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kassir
     */
    public function cashiers(): CashiersSegment
    {
        return $this->resolveNamedBuilder(CashiersSegment::class);
    }
}
