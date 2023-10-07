<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\AttributesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CharacteristicsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StatesSegment;

trait CharacteristicsTrait
{
    /**
     * Статусы.
     *
     * <code>
     * $counterpartyState = $ms->query()
     *  ->entity()
     *  ->variant()
     *  ->metadata()
     *  ->characteristics()
     *  ->byId('6eb8b7ac-296f-11ee-0a80-0b150057895b')
     *  ->get();
     * </code>
     */
    public function characteristics(): CharacteristicsSegment
    {
        return $this->resolveNamedBuilder(CharacteristicsSegment::class);
    }
}