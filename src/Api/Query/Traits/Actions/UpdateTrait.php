<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;

trait UpdateTrait
{
    /**
     * Обновление сущности.
     *
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->update(['name' => 'orange']);
     * </code>
     *
     * @throws RequestException
     */
    public function update(mixed $body)
    {
        return $this->apiSend(HttpMethod::PUT, $body);
    }
}
