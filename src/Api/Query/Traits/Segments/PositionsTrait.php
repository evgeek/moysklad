<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\PositionsSegment;

trait PositionsTrait
{
    /**
     * Позиции сущности.
     *
     * <code>
     * $order = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->byId('efe3944b-980d-11ec-0a80-0d180027c266')
     *  ->positions()
     *  ->get();
     * </code>
     */
    public function positions(): PositionsSegment
    {
        return $this->resolveNamedBuilder(PositionsSegment::class);
    }
}
