<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ProcessingPositionMaterialSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ProcessingPositionResultSegment;

class ByIdProcessingSegment extends AbstractByIdSegment
{
    /**
     * Материалы Техоперации
     *
     * <code>
     * $cashiers = $ms->query()
     *   ->entity()
     *   ->processing()
     *   ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *   ->materials()
     *   ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-tehoperaciq-material-tehoperacii
     */
    public function materials(): ProcessingPositionMaterialSegment
    {
        return $this->resolveNamedBuilder(ProcessingPositionMaterialSegment::class);
    }

    /**
     * Продукты Техоперации
     *
     * <code>
     * $cashiers = $ms->query()
     *   ->entity()
     *   ->processing()
     *   ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *   ->products()
     *   ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-tehoperaciq-produkty-tehoperacii
     */
    public function products(): ProcessingPositionResultSegment
    {
        return $this->resolveNamedBuilder(ProcessingPositionResultSegment::class);
    }
}
