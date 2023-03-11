<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Methods\Nested;

use Evgeek\Moysklad\Api\Segments\Methods\AbstractMethodSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Segments\AttributesTrait;
use Evgeek\Moysklad\Api\Traits\Segments\ByIdCommonTrait;

class MetadataSegment extends AbstractMethodSegmentNamed
{
    use AttributesTrait;
    use ByIdCommonTrait;
    use ExpandTrait;
    use GetTrait;

    public const SEGMENT = 'metadata';
}
