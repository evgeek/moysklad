<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Methods\Nested;

use Evgeek\Moysklad\Api\Builders\Methods\MethodNamed;
use Evgeek\Moysklad\Api\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;

final class Attributes extends MethodNamed
{
    use ByIdCommonTrait;
    use CreateTrait;
    use GetGeneratorTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use MassDeleteTrait;

    public const NAME = 'attributes';
}
