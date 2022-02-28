<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Crud;

use Evgeek\Moysklad\Api\Methods\Special\MassDelete;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;

trait MassDeleteTrait
{
    /**
     * Mass delete entity (POST http request to /delete)
     * @throws FormatException
     * @throws ApiException
     */
    public function massDelete(string|array|object $body): object|array|string
    {
        $payloadList = $this->addPayloadToList();
        return (new MassDelete($this->api, $payloadList))->massDelete($body);
    }
}