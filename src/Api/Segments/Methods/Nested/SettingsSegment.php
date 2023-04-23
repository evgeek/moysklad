<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Methods\Nested;

use Evgeek\Moysklad\Api\Segments\Methods\AbstractMethodSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\UpdateTrait;

class SettingsSegment extends AbstractMethodSegmentNamed
{
    use GetTrait;
    use UpdateTrait;

    public const SEGMENT = 'settings';
}
