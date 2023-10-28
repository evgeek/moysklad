<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\MetadataForVariantSegment;

trait MetadataForVariantTrait
{
    /**
     * Метаданные сущности.
     *
     * <code>
     * $productMetadata = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->metadata()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-metadannye
     */
    public function metadata(): MetadataForVariantSegment
    {
        return $this->resolveNamedBuilder(MetadataForVariantSegment::class);
    }
}
