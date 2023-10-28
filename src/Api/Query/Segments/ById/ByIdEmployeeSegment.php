<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\SecuritySegment;

class ByIdEmployeeSegment extends AbstractByIdSegment
{
    /**
     * Права сотрудника.
     *
     * <code>
     * $security = $ms->query()
     *  ->entity()
     *  ->employee()
     *  ->byId('efe3944b-980d-11ec-0a80-0d180027c266')
     *  ->security()
     *  ->get();
     * </code>
     */
    public function security(): SecuritySegment
    {
        return $this->resolveNamedBuilder(SecuritySegment::class);
    }
}
