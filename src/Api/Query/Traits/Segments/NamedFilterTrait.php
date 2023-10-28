<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\NamedFilterSegment;

trait NamedFilterTrait
{
    /**
     * Сохранённые фильтры сущности или документа.
     *
     * <code>
     * $productFilters = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->namedfilter()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sohranennye-fil-try
     */
    public function namedfilter(): NamedFilterSegment
    {
        return $this->resolveNamedBuilder(NamedFilterSegment::class);
    }
}
