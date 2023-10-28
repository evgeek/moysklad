<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class UserSettingsSegment extends AbstractMethodNamedSegment
{
    use GetGeneratorTrait;
    use UpdateTrait;

    public const SEGMENT = Segment::USERSETTINGS;
}
