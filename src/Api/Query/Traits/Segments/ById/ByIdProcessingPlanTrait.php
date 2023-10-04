<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdProcessingPlanSegment;

trait ByIdProcessingPlanTrait
{
    /**
     * Работа с одиночной техкартой по id.
     *
     * <code>
     * $processingPlanStages = $ms->query()
     *  ->entity()
     *  ->processingplan()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->stages()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-tehkarta
     */
    public function byId(string $guid): ByIdProcessingPlanSegment
    {
        return $this->resolveCommonBuilder(ByIdProcessingPlanSegment::class, $guid);
    }
}
