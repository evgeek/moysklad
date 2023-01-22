<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Builders\Methods\Special\Debug;

trait DebugTrait
{
    /**
     * Set it before the CRUD method to generate debug information for the request
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
