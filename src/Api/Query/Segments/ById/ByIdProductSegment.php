<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\SecuritySegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\FilesTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ImagesTrait;

class ByIdProductSegment extends AbstractByIdSegment
{
    use FilesTrait;
    use ImagesTrait;
}
