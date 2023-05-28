<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdSegmentPositioned;

trait ByIdPositionedTrait
{
    /**
     * Работа с одиночной сущностью с позициями по id.
     *
     * <code>
     * $order = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->byId('efe3944b-980d-11ec-0a80-0d180027c266')
     *  ->positions()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->get();
     * </code>
     */
    public function byId(string $guid): ByIdSegmentPositioned
    {
        return $this->resolveCommonBuilder(ByIdSegmentPositioned::class, $guid);
    }
}
