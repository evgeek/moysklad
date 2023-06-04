<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Special;

use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;

class MassDeleteSegment extends AbstractSegmentNamed
{
    protected const SEGMENT = 'delete';

    /**
     * @throws RequestException
     */
    public function massDelete(mixed $objects)
    {
        return $this->apiSend(HttpMethod::POST, $objects);
    }

    public function massDeleteDebug(mixed $objects)
    {
        return $this->apiDebug(HttpMethod::POST, $objects);
    }
}
