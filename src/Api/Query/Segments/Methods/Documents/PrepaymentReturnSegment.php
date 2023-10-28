<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Documents;

use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdWithPositionsTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class PrepaymentReturnSegment extends AbstractDocumentSegment
{
    use ByIdWithPositionsTrait;
    use MetadataTrait;

    public const SEGMENT = Segment::PREPAYMENTRETURN;
}
