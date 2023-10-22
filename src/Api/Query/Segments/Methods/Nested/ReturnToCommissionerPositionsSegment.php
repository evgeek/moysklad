<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Nested;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\AbstractDocumentSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassCreateUpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdWithPositionsTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class ReturnToCommissionerPositionsSegment extends AbstractMethodNamedSegment
{
    use ByIdWithPositionsTrait;
    use CreateTrait;
    use MassDeleteTrait;

    public const SEGMENT = Segment::RETURNTOCOMMISSIONERPOSITIONS;
}
