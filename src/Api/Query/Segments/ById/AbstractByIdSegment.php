<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\UpdateTrait;

abstract class AbstractByIdSegment extends AbstractCommonSegment
{
    use DeleteTrait;
    use UpdateTrait;
}
