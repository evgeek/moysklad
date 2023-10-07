<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\EmbeddedTemplateSegment;

trait EmbeddedTemplateTrait
{
    /**
     * Стандартные шаблоны.
     *
     * <code>
     * $productFiles = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->metadata()
     *  ->embeddedtemplate()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy-spisok-standartnyh-shablonow
     */
    public function embeddedtemplate(): EmbeddedTemplateSegment
    {
        return $this->resolveNamedBuilder(EmbeddedTemplateSegment::class);
    }
}
