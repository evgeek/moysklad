<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Segments\Methods\MethodSegmentCommon;

trait MethodCommonTrait
{
    /**
     * Добавление сегмента к цепочке в url
     *
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->method('product')
     *  ->get();
     * </code>
     */
    public function method(string $name): MethodSegmentCommon
    {
        return $this->resolveCommonBuilder(MethodSegmentCommon::class, $name);
    }
}
