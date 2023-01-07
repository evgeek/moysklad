<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Methods;

use Evgeek\Moysklad\Api\Methods\MethodCommon;

trait CommonMethodTrait
{
    /**
     * Nested URL path
     * <code>
     * $product = $ms->entity()
     *      ->method('product')
     *      ->get();
     * </code>
     */
    public function method(string $entity): MethodCommon
    {
        $this->addPayloadToList();

        return new MethodCommon($this->api, $this->payloadList, $entity);
    }
}
