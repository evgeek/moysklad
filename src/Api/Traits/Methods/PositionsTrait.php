<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Methods;

use Evgeek\Moysklad\Api\Methods\Nested\Positions;

trait PositionsTrait
{
    /**
     * Entity positions
     * <code>
     * $order = $ms->entity()
     *      ->customerorder()
     *      ->byId('efe3944b-980d-11ec-0a80-0d180027c266')
     *      ->positions()
     *      ->get();
     * </code>
     */
    public function positions(): Positions
    {
        $this->addPayloadToList();

        return new Positions($this->api, $this->payloadList);
    }
}
