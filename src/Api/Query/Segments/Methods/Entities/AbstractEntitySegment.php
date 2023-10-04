<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\NamedFilterTrait;

abstract class AbstractEntitySegment extends AbstractMethodNamedSegment
{
    use NamedFilterTrait;
    use GetGeneratorTrait;
}
