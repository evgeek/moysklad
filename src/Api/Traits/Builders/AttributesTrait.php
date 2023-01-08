<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Builders;

use Evgeek\Moysklad\Api\Builders\Methods\Nested\Attributes;

trait AttributesTrait
{
    /**
     * Attributes
     * <code>
     * $product = $ms->query()
     *      ->entity()
     *      ->product()
     *      ->metadata()
     *      ->attributes()
     *      ->get();
     * </code>
     */
    public function attributes(): Attributes
    {
        return $this->resolveNamedBuilder(Attributes::class);
    }
}
