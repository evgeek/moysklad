<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractUnknownApiObject;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetIdPathTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetMetaTrait;

class UnknownObject extends AbstractUnknownApiObject
{
    use SetIdPathTrait;
    use SetMetaTrait;
}
