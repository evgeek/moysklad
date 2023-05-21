<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

class ApiObjectBuilder extends AbstractObjectBuilder
{
    /**
     * Конструктор сущностей.
     */
    public function single(): SingleObjectBuilder
    {
        return new SingleObjectBuilder($this->ms);
    }

    /**
     * Конструктр коллекций.
     */
    public function collection(): CollectionObjectBuilder
    {
        return new CollectionObjectBuilder($this->ms);
    }
}
