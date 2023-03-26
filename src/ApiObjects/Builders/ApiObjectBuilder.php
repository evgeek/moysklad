<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

class ApiObjectBuilder extends AbstractObjectBuilder
{
    public function single(): SingleObjectBuilder
    {
        return new SingleObjectBuilder($this->ms);
    }

    public function collection(): CollectionObjectBuilder
    {
        return new CollectionObjectBuilder($this->ms);
    }
}
