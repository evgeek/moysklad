<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Api\Query\Debug;

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
    public function debug(): Debug
    {
        return new Debug($this->api, $this->path, $this->params);
    }
}
