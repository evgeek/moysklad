<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\AttributesSegment;

trait AttributesTrait
{
    /**
     * Атрибуты.
     *
     * <code>
     * $attributes = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->metadata()
     *  ->attributes()
     *  ->get();
     * </code>
     */
    public function attributes(): AttributesSegment
    {
        return $this->resolveNamedBuilder(AttributesSegment::class);
    }
}
