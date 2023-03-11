<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Methods\Documents;

use Evgeek\Moysklad\Api\Segments\Methods\AbstractMethodSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Traits\Params\SearchTrait;
use Evgeek\Moysklad\Api\Traits\Segments\ByIdPositionedTrait;
use Evgeek\Moysklad\Api\Traits\Segments\MetadataTrait;

class CustomerorderSegment extends AbstractMethodSegmentNamed
{
    use ByIdPositionedTrait;
    use CreateTrait;
    use ExpandTrait;
    use FilterTrait;
    use GetGeneratorTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use MassDeleteTrait;
    use MetadataTrait;
    use OrderTrait;
    use SearchTrait;

    public const SEGMENT = 'customerorder';
}
