<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Segments\Methods\Nested\SettingsSegment;

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
