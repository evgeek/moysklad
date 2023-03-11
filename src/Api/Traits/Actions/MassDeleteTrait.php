<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Segments\Special\MassDeleteSegment;
use Evgeek\Moysklad\Exceptions\RequestException;

trait MassDeleteTrait
{
    /**
     * Mass delete entity (POST http request to /delete)
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->massDelete($body);
     * </code>
     *
     * @throws RequestException
     */
    public function massDelete(mixed $body)
    {
        return (new MassDeleteSegment($this->api, $this->path, $this->params))->massDelete($body);
    }
}
