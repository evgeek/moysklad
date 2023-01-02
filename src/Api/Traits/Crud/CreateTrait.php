<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Crud;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;

trait CreateTrait
{
    /**
     * Create entity (GET http request)
     * <code>
     * $product = $ms->entity()
     *      ->product()
     *      ->create(['name' => 'orange']);
     * </code>
     *
     * @throws FormatException
     * @throws ApiException
     */
    public function create(string|array|object $body): object|array|string
    {
        $payloadList = $this->addPayloadToList(HttpMethod::POST, $body);

        return $this->apiSend($payloadList);
    }
}
