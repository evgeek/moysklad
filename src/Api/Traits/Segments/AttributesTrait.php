<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Segments\Methods\Nested\AttributesSegment;

trait AttributesTrait
{
    /**
     * Атрибуты.
     *
     * <code>
     * $product = $ms->query()
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
