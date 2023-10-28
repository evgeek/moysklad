<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Nested;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdCommonTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class CustomTemplateSegment extends AbstractMethodNamedSegment
{
    use ByIdCommonTrait;

    public const SEGMENT = Segment::CUSTOMTEMPLATE;
}
