<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Builders\Methods\Special\MassDelete;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;
use stdClass;

trait MassDeleteTrait
{
    /**
     * Mass delete entity (POST http request to /delete)
     * <code>
     * $products = $ms->query()
     *      ->entity()
     *      ->customerorder()
     *      ->massDelete($body);
     * </code>
     *
     * @throws FormatException
     * @throws ApiException
     */
    public function massDelete(stdClass|array|string $body): stdClass|array|string
    {
        return (new MassDelete($this->api, $this->url))->massDelete($body);
    }
}
