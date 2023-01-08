<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Builders;

use Evgeek\Moysklad\Api\Builders\Methods\MethodCommon;

trait MethodCommonTrait
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
