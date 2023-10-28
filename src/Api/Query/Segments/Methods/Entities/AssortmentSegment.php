<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\SettingsSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class AssortmentSegment extends AbstractEntitySegment
{
    use MassDeleteTrait;

    public const SEGMENT = Segment::ASSORTMENT;

    /**
     * Настройки справочника товаров.
     *
     * <code>
     * $settings = $ms->query()
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
