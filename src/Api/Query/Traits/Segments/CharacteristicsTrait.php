<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CharacteristicsSegment;

trait CharacteristicsTrait
{
    /**
     * Характеристики модификаций.
     *
     * <code>
     * $characteristics = $ms->query()
     *  ->entity()
     *  ->variant()
     *  ->metadata()
     *  ->characteristics()
     *  ->get();
     * </code>
     */
    public function characteristics(): CharacteristicsSegment
    {
        return $this->resolveNamedBuilder(CharacteristicsSegment::class);
    }
}
