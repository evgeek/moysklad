<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StatesSegment;

trait StatesTrait
{
    /**
     * Статусы.
     *
     * <code>
     * $counterpartyState = $ms->query()
     *  ->entity()
     *  ->counterparty()
     *  ->metadata()
     *  ->states()
     *  ->byId('6eb8b7ac-296f-11ee-0a80-0b150057895b')
     *  ->get();
     * </code>
     */
    public function states(): StatesSegment
    {
        return $this->resolveNamedBuilder(StatesSegment::class);
    }
}
