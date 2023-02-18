<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Segments\Methods\Nested\Positions;

trait PositionsTrait
{
    /**
     * Entity positions
     * <code>
     * $order = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->byId('efe3944b-980d-11ec-0a80-0d180027c266')
     *  ->positions()
     *  ->get();
     * </code>
     */
    public function positions(): Positions
    {
        return $this->resolveNamedBuilder(Positions::class);
    }
}
