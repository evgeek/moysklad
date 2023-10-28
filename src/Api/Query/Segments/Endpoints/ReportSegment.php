<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Dictionaries\Segment;

class ReportSegment extends AbstractNamedSegment
{
    protected const SEGMENT = Segment::REPORT;
}
