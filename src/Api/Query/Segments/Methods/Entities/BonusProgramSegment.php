<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdCommonTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class BonusProgramSegment extends AbstractEntitySegment
{
    use ByIdCommonTrait;
    use CreateTrait;
    use MassDeleteTrait;

    public const SEGMENT = Segment::BONUSPROGRAM;
}
