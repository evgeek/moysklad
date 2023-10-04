<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\AbstractConcreteRecord;
use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
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

    protected function resolveNestedObject(string $type, ObjectInterface|array|string $parent, mixed $content): AbstractNestedObject
    {
        return RecordMappingHelper::resolveNestedObject($this->ms, $parent, $type, $content);
    }

    protected function resolveCollection(string $type): AbstractConcreteCollection
    {
        return RecordMappingHelper::resolveCollection($this->ms, $type);
    }

    protected function resolveNestedCollection(string $type, ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return RecordMappingHelper::resolveNestedCollection($this->ms, $parent, $type);
    }
}
