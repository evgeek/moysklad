<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\SettingsSegment;

trait SettingsTrait
{
    /**
     * Настройки сущности.
     *
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->assortment()
     *  ->settings()
     *  ->get();
     * </code>
     */
    public function settings(): SettingsSegment
    {
        return $this->resolveNamedBuilder(SettingsSegment::class);
    }
}
