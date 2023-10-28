<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Traits\Segments\FilesTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ImagesTrait;

class ByIdBundleSegment extends AbstractByIdSegment
{
    use FilesTrait;
    use ImagesTrait;
}
