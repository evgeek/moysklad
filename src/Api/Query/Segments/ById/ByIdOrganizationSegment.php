<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\AccountsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\SecuritySegment;

class ByIdOrganizationSegment extends AbstractByIdSegment
{
    /**
     * Список счетов организации.
     *
     * <code>
     * $security = $ms->query()
     *  ->entity()
     *  ->organization()
     *  ->byId('efe3944b-980d-11ec-0a80-0d180027c266')
     *  ->accounts()
     *  ->get();
     * </code>
     */
    public function accounts(): AccountsSegment
    {
        return $this->resolveNamedBuilder(AccountsSegment::class);
    }
}
