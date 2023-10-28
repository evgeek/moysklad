<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\FilesSegment;

trait FilesTrait
{
    /**
     * Файлы сущности.
     *
     * <code>
     * $productFiles = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->files()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-fajly
     */
    public function files(): FilesSegment
    {
        return $this->resolveNamedBuilder(FilesSegment::class);
    }
}
