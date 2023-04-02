<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\ApiObjects\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\Formatters\ApiObjectMapping;
use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;

class AbstractObjectBuilder
{
    public function __construct(protected readonly MoySklad $ms)
    {
    }

    protected function resolveObject(string $type, mixed $content): AbstractConcreteObject
    {
        $class = $this->getMapping()->getObject($type);

        if (!is_a($class, AbstractConcreteObject::class, true)) {
            throw new InvalidArgumentException("Object type '$type' has no mapped class");
        }

        return new $class($this->ms, $content);
    }

    protected function resolveCollection(string $type, mixed $content): AbstractConcreteCollection
    {
        $class = $this->getMapping()->getCollection($type);

        if (!is_a($class, AbstractConcreteCollection::class, true)) {
            throw new InvalidArgumentException("Collection type '$type' has no mapped class");
        }

        return new $class($this->ms, $content);
    }

    private function getMapping(): ApiObjectMapping
    {
        $formatter = $this->ms->getApiClient()->getFormatter();

        return is_a($formatter, ApiObjectFormatter::class) ?
            $formatter->getMapping() :
            new ApiObjectMapping();
    }
}
