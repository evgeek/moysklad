<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\InputException;
use stdClass;

trait SendTrait
{
    /**
     * Generic HTTP request
     * <code>
     * $product = $ms->query()
     *      ->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->send('PUT', ['name' => 'orange']);
     * </code>
     *
     * @throws FormatException
     * @throws ApiException
     * @throws InputException
     */
    public function send(HttpMethod|string $method, stdClass|array|string|null $body = null): stdClass|array|string
    {
        return $this->apiSend($this->getEnumMethod($method), $body);
    }
}