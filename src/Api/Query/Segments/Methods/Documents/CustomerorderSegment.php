<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Documents;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodSegmentNamed;
use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\SearchTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ByIdPositionedTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataTrait;

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
