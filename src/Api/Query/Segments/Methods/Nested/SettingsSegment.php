<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Nested;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodSegmentNamed;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\UpdateTrait;

class SettingsSegment extends AbstractMethodSegmentNamed
{
    use GetTrait;
    use UpdateTrait;

    public const SEGMENT = 'settings';
}
