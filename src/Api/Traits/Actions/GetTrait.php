<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;

trait GetTrait
{
    /**
     * Read single entity or list (GET http request)
     * <code>
     * $products = $ms->query()
     *      ->entity()
     *      ->product()
     *      ->get();
     * </code>
     *
     * @throws FormatException
     * @throws ApiException
     */
    public function get()
    {
        return $this->apiSend(HttpMethod::GET);
    }
}
