<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\RecordMappingHelper;

class AbstractBuilder
{
    public function __construct(protected readonly MoySklad $ms)
    {
    }

    protected function resolveObject(string $type, mixed $content): AbstractConcreteObject
    {
        return RecordMappingHelper::resolveObject($this->ms, $type, $content);
    }

    protected function resolveCollection(string $type): AbstractConcreteCollection
    {
        return RecordMappingHelper::resolveCollection($this->ms, $type);
    }
}
