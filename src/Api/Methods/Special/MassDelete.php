<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Special;

use Evgeek\Moysklad\Api\Methods\MethodNamed;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Http\Payload;

class MassDelete extends MethodNamed
{
    protected const PATH = 'delete';

    /**
     * @throws FormatException
     * @throws ApiException
     */
    public function massDelete(string|array|object $body): object|array|string
    {
        $payloadList = $this->addPayloadToList(HttpMethod::POST, $body);

        return $this->apiSend($payloadList);
    }

    /**
     * @throws FormatException
     */
    public function massDeleteDebug(Payload $debugPayload): object|array|string
    {
        $payloadList = $this->addPayloadToList(HttpMethod::POST);
        $this->payloadList->push($debugPayload);

        return $this->apiDebug($payloadList);
    }
}
