<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AbstractUnknownApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\Traits\SetMetaTrait;

class UnknownCollection extends AbstractUnknownApiObject
{
    use SetMetaTrait;
}
