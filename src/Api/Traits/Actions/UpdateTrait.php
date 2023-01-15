<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;

trait UpdateTrait
{
    /**
     * Update entity (PUT http request)
     * <code>
     * $product = $ms->query()
     *      ->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->update(['name' => 'orange']);
     * </code>
     *
     * @throws FormatException
     * @throws ApiException
     */
    public function update(mixed $body)
    {
        return $this->apiSend(HttpMethod::PUT, $body);
    }
}
