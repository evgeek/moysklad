<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;

trait SendTrait
{
    /**
     * Универсальный метод, позволяющий отправлять произвольный HTTP-запрос.
     *
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->send('PUT', ['name' => 'orange']);
     * </code>
     *
     * @throws RequestException
     */
    public function send(HttpMethod|string $method, mixed $body = null)
    {
        return $this->apiSend(HttpMethod::makeFrom($method), $body);
    }
}
