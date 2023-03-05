<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\MoySklad;

class AbstractBuilder
{
    public function __construct(protected readonly MoySklad $ms)
    {
    }
}
