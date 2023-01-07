<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Methods;

use Evgeek\Moysklad\Api\Methods\ById;
use Evgeek\Moysklad\Api\Methods\ByIdCommon;

trait CommonMethodByIdTrait
{
    /**
     * Single entity by id
     * <code>
     * $product = $ms->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->get();
     * </code>
     *
     * @return ByIdCommon
     */
    public function byId(string $guid): ById
    {
        $this->addPayloadToList();

        return new ByIdCommon($this->api, $this->payloadList, $guid);
    }
}
