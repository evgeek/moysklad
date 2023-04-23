<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\ApiObjects\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\ApiObjectMappingHelper;

class AbstractObjectBuilder
{
    public function __construct(protected readonly MoySklad $ms)
    {
    }

    protected function resolveObject(string $type, mixed $content): AbstractConcreteObject
    {
        return ApiObjectMappingHelper::resolveObject($this->ms, $type, $content);
    }

    protected function resolveCollection(string $type): AbstractConcreteCollection
    {
        return ApiObjectMappingHelper::resolveCollection($this->ms, $type);
    }
}
