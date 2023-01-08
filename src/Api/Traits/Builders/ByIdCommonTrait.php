<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Builders;

use Evgeek\Moysklad\Api\Builders\ById\ByIdCommon;

trait ByIdCommonTrait
{
    /**
     * Single entity by id
     * <code>
     * $product = $ms->query()
     *      ->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->get();
     * </code>
     */
    public function byId(string $guid): ByIdCommon
    {
        return $this->resolveCommonBuilder(ByIdCommon::class, $guid);
    }
}
