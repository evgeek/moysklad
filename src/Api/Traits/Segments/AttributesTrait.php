<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Segments\Methods\Nested\Attributes;

trait AttributesTrait
{
    /**
     * Attributes
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->metadata()
     *  ->attributes()
     *  ->get();
     * </code>
     */
    public function attributes(): Attributes
    {
        return $this->resolveNamedBuilder(Attributes::class);
    }
}
