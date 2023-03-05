<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

class ApiBuilder extends AbstractBuilder
{
    public function single(): SingleBuilder
    {
        return new SingleBuilder($this->ms);
    }

    public function collection(): CollectionBuilder
    {
        return new CollectionBuilder($this->ms);
    }
}
