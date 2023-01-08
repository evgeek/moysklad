<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Methods\Special;

use Evgeek\Moysklad\Api\Builders\Methods\MethodNamed;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;
use stdClass;

class MassDelete extends MethodNamed
{
    protected const PATH = 'delete';

    /**
     * @throws FormatException
     * @throws ApiException
     */
    public function massDelete(stdClass|array|string $body): stdClass|array|string
    {
        return $this->apiSend(HttpMethod::POST, $body);
    }

    /**
     * @throws FormatException
     */
    public function massDeleteDebug(stdClass|array|string $body): stdClass|array|string
    {
        return $this->apiDebug(HttpMethod::POST, $body);
    }
}
