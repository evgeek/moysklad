<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\CompanySettingsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\UserSettingsSegment;
use Evgeek\Moysklad\Dictionaries\Segment;

class ContextSegment extends AbstractNamedSegment
{
    protected const SEGMENT = Segment::CONTEXT;

    /**
     * Настройки компании
     *
     * <code>
     * $companySettings = $ms->query()
     *  ->context()
     *  ->companysettings()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-kompanii
     */
    public function companysettings(): CompanySettingsSegment
    {
        return $this->resolveNamedBuilder(CompanySettingsSegment::class);
    }

    /**
     * Настройки пользователя
     *
     * <code>
     * $userSettings = $ms->query()
     *  ->context()
     *  ->usersettings()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-pol-zowatelq
     */
    public function usersettings(): UserSettingsSegment
    {
        return $this->resolveNamedBuilder(UserSettingsSegment::class);
    }
}
