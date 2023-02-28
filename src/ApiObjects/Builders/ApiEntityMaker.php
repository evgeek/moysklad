<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

class ApiEntityMaker extends AbstractObjectBuilder
{
    public function entity(): Entity
    {
        return new Entity($this->formatter);
    }
}
