<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Builders;

use Evgeek\Moysklad\Api\Builders\ById\ById;
use Evgeek\Moysklad\Api\Builders\ById\ByIdPositioned;

trait ByIdPositionedTrait
{
    /**
     * Single entity with positions by id
     * <code>
     * $order = $ms->query()
     *      ->entity()
     *      ->customerorder()
     *      ->byId('efe3944b-980d-11ec-0a80-0d180027c266')
     *      ->positions()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->get();
     * </code>
     */
    public function byId(string $guid): ByIdPositioned
    {
        return $this->resolveCommonBuilder(ByIdPositioned::class, $guid);
    }
}
