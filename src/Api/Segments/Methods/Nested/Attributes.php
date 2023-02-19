<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Methods\Nested;

use Evgeek\Moysklad\Api\Segments\Methods\AbstractMethodNamed;
use Evgeek\Moysklad\Api\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Segments\ByIdCommonTrait;

class Attributes extends AbstractMethodNamed
{
    use ByIdCommonTrait;
    use CreateTrait;
    use GetGeneratorTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use MassDeleteTrait;

    public const SEGMENT = 'attributes';
}
