<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Methods;

use Evgeek\Moysklad\Api\Methods\AbstractMethodById;
use Evgeek\Moysklad\Api\Methods\CommonMethodById;

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
     * @return CommonMethodById
     */
    public function byId(string $guid): AbstractMethodById
    {
        $this->addPayloadToList();

        return new CommonMethodById($this->api, $this->payloadList, $guid);
    }
}
