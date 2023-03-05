<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\MoySklad;

interface WithMoySkladInterface
{
    public function setMoySklad(MoySklad $ms): static;
}
