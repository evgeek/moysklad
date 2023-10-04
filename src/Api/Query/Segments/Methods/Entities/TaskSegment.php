<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassCreateUpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdWithFilesTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class TaskSegment extends AbstractEntitySegment
{
    use ByIdWithFilesTrait;
    use CreateTrait;
    use MassCreateUpdateTrait;
    use MassDeleteTrait;

    public const SEGMENT = Segment::TASK;
}
