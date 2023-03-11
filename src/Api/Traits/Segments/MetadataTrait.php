<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Segments\Methods\Nested\MetadataSegment;

trait MetadataTrait
{
    /**
     * Entity metadata
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->metadata()
     *  ->get();
     * </code>
     */
    public function metadata(): MetadataSegment
    {
        return $this->resolveNamedBuilder(MetadataSegment::class);
    }
}
