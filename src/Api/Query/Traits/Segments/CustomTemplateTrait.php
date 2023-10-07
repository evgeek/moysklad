<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CustomTemplateSegment;

trait CustomTemplateTrait
{
    /**
     * Пользовательские шаблоны.
     *
     * <code>
     * $productFiles = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->metadata()
     *  ->customtemplate()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy-spisok-pol-zowatel-skih-shablonow
     */
    public function customtemplate(): CustomTemplateSegment
    {
        return $this->resolveNamedBuilder(CustomTemplateSegment::class);
    }
}
