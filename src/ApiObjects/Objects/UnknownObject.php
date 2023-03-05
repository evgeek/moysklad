<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractUnknownApiObject;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetMetaTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetPathTrait;

class UnknownObject extends AbstractUnknownApiObject
{
    use SetMetaTrait;
    use SetPathTrait;
}
