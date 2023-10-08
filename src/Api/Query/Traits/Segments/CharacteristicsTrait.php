<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\AttributesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CharacteristicsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StatesSegment;

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
