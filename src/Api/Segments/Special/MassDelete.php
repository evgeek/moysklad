<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Special;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;

class MassDelete extends AbstractSegmentNamed
{
    protected const SEGMENT = 'delete';

    /**
     * @throws FormatException
     * @throws ApiException
     */
    public function massDelete(mixed $body)
    {
        return $this->apiSend(HttpMethod::POST, $body);
    }

    /**
     * @throws FormatException
     */
    public function massDeleteDebug(mixed $body)
    {
        return $this->apiDebug(HttpMethod::POST, $body);
    }
}
