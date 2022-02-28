<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Crud;

use Evgeek\Moysklad\Api\Methods\Special\Debug;

trait DebugTrait
{

    /**
     * Set it before the CRUD method to generate debug information for the request
     * <code>
     * $products = $ms->entity()
     *      ->product()
     *      ->limit(100)
     *      ->offset(0)
     *      ->debug()
     *      ->get();
     * </code>
     */
    public function debug(): Debug
    {
        $payloadList = $this->addPayloadToList();
        return new Debug($this->api, $payloadList);
    }
}