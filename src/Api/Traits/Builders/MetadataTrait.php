<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Builders;

use Evgeek\Moysklad\Api\Builders\Methods\Nested\Metadata;

trait MetadataTrait
{
    /**
     * Entity metadata
     * <code>
     * $product = $ms->query()
     *      ->entity()
     *      ->product()
     *      ->metadata()
     *      ->get();
     * </code>
     */
    public function metadata(): Metadata
    {
        return $this->resolveNamedBuilder(Metadata::class);
    }
}
