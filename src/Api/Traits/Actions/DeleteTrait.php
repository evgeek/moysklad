<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;

trait DeleteTrait
{
    /**
     * Delete entity (DELETE http request)
     * <code>
     * $ms->query()
     *      ->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->delete();
     * </code>
     *
     * @throws FormatException
     * @throws ApiException
     */
    public function delete()
    {
        return $this->apiSend(HttpMethod::DELETE);
    }
}
