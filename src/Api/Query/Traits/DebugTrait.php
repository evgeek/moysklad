<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits;

use Evgeek\Moysklad\Api\Query\DebugBuilder;

trait DebugTrait
{
    /**
     * Отладочный метод.
     * Разместите его перед любым CRUD-методом, и он вернёт детальную информацию о запросе, не выполняя сам запрос.
     *
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->limit(100)
     *  ->offset(0)
     *  ->debug()
     *  ->get();
     * </code>
     */
    public function debug(): DebugBuilder
    {
        return new DebugBuilder($this->api, $this->path, $this->params);
    }
}
