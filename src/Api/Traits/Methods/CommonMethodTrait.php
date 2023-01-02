<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Methods;

use Evgeek\Moysklad\Api\Methods\CommonMethod;

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
    public function method(string $entity): CommonMethod
    {
        $this->addPayloadToList();
        return new CommonMethod($this->api, $this->payloadList, $entity);
    }
}
