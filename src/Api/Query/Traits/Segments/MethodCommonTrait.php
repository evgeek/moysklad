<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\MethodCommonSegment;

trait MethodCommonTrait
{
    /**
     * Универсальный метод для добавления сегмента к цепочке в url.
     *
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->method('product')
     *  ->get();
     * </code>
     */
    public function method(string $name): MethodCommonSegment
    {
        return $this->resolveCommonBuilder(MethodCommonSegment::class, $name);
    }
}
