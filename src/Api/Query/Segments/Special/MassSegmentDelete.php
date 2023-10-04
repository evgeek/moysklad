<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Special;

use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;

class MassSegmentDelete extends AbstractNamedSegment
{
    protected const SEGMENT = Segment::DELETE;

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
