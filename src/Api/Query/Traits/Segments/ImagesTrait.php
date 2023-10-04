<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\FilesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ImagesSegment;

trait ImagesTrait
{
    /**
     * Изображения сущности.
     *
     * <code>
     * $productFiles = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->images()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-izobrazhenie
     */
    public function images(): ImagesSegment
    {
        return $this->resolveNamedBuilder(ImagesSegment::class);
    }
}
