<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Segments\Special\MassDeleteSegment;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Services\CollectionHelper;

trait MassDeleteTrait
{
    /**
     * Массовое удаление сущностей.
     *
     * <code>
     * $product1 = $ms->query()->entity()->product()->byId('cc181c35-f259-11ed-0a80-00e900658c8f')->get();
     * $product2 = Product::make($ms, ['id' => 'd540c409-f259-11ed-0a80-00e900658e53']);
     * $product3 = ['meta' => Meta::product('d540c409-f259-11ed-0a80-00e900658e53')];
     *
     * $products = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->massDelete([$product1, $product2, $product3]);
     * </code>
     *
     * @throws RequestException
     */
    public function massDelete(mixed $objects)
    {
        $objects = CollectionHelper::extractRows($objects);

        return (new MassDeleteSegment($this->api, $this->path, $this->params))->massDelete($objects);
    }
}
