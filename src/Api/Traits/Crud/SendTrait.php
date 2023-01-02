<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Crud;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\InputException;

trait SendTrait
{
    /**
     * Generic HTTP request
     * <code>
     * $product = $ms->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->send('PUT', ['name' => 'orange']);
     * </code>
     * @throws FormatException
     * @throws ApiException
     * @throws InputException
     */
    public function send(HttpMethod|string $method, string|array|object|null $body = null): object|array|string
    {
        $method = $this->getEnumMethod($method);
        $payloadList = $this->addPayloadToList($method, $body);
        return $this->apiSend($payloadList);
    }
}
