<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdEmployeeSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdOrganizationSegment;

trait ByIdOrganizationTrait
{
    /**
     * Работа с организацией по id.
     *
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->organization()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->get();
     * </code>
     */
    public function byId(string $guid): ByIdOrganizationSegment
    {
        return $this->resolveCommonBuilder(ByIdOrganizationSegment::class, $guid);
    }
}
