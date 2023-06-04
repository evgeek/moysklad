<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Builders;

class RecordBuilder extends AbstractBuilder
{
    /**
     * Конструктор сущностей.
     */
    public function object(): ObjectBuilder
    {
        return new ObjectBuilder($this->ms);
    }

    /**
     * Конструктр коллекций.
     */
    public function collection(): CollectionBuilder
    {
        return new CollectionBuilder($this->ms);
    }
}
