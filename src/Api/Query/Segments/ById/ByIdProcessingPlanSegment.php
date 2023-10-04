<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\MaterialsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ProductsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StagesSegment;

class ByIdProcessingPlanSegment extends AbstractByIdSegment
{
    /**
     * Этапы техкарты.
     *
     * <code>
     * $processingPlanStages = $ms->query()
     *   ->entity()
     *   ->processingplan()
     *   ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *   ->stages()
     *   ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-jetapy-tehkarty
     */
    public function stages(): StagesSegment
    {
        return $this->resolveNamedBuilder(StagesSegment::class);
    }

    /**
     * Материалы техкарты.
     *
     * <code>
     * $processingPlanMaterials = $ms->query()
     *   ->entity()
     *   ->processingplan()
     *   ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *   ->materials()
     *   ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-materialy-tehkarty
     */
    public function materials(): MaterialsSegment
    {
        return $this->resolveNamedBuilder(MaterialsSegment::class);
    }

    /**
     * Продукты техкарты.
     *
     * <code>
     * $processingPlanResults = $ms->query()
     *   ->entity()
     *   ->processingplan()
     *   ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *   ->products()
     *   ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-materialy-tehkarty
     */
    public function products(): ProductsSegment
    {
        return $this->resolveNamedBuilder(ProductsSegment::class);
    }
}
