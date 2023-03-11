<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Segments\Methods\MethodSegmentCommon;

trait MethodCommonTrait
{
    /**
     * Nested URL path
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->method('product')
     *  ->get();
     * </code>
     */
    public function method(string $entity): MethodSegmentCommon
    {
        return $this->resolveCommonBuilder(MethodSegmentCommon::class, $entity);
    }
}
