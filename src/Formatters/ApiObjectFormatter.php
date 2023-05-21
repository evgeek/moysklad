<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use stdClass;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatterInterface<stdClass>
 */
class ApiObjectFormatter extends AbstractMultiDecoder implements WithMoySkladInterface
{
    protected MoySklad $ms;

    public function __construct(private readonly ApiObjectMapping $mapping = new ApiObjectMapping())
    {
    }

    public function setMoySklad(MoySklad $ms): static
    {
        $this->ms = $ms;

        return $this;
    }

    public function getMapping(): ApiObjectMapping
    {
        return $this->mapping;
    }

    /**
     * @return AbstractApiObject|array<AbstractApiObject>|array<stdClass>|stdClass
     */
    public function encode(string $content): AbstractApiObject|stdClass|array
    {
        if ($content === '') {
            return new stdClass();
        }

        try {
            $encodedContent = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            $this->throwContentIsNotValidJsonObject($content);
        }

        if (!is_array($encodedContent)) {
            $this->throwContentIsNotValidJsonObject($content);
        }

        return $this->encodeToStdClass($encodedContent);
    }

    public function encodeToStdClass(array $content): AbstractApiObject|stdClass|array
    {
        $result = $this->encodeArray($content);

        return $this->convertToStdClass($result);
    }

    protected function encodeArray(array $content): array|AbstractApiObject
    {
        $object = $this->tryConvertToApiObject($content);
        if (is_a($object, AbstractApiObject::class)) {
            return $object;
        }

        foreach ($content as $key => $value) {
            $content[$key] = is_array($value) ?
                $this->tryConvertToApiObject($value) :
                $value;

            if (is_array($content[$key])) {
                $content[$key] = $this->encodeArray($value);
            }
        }

        return $content;
    }

    protected function tryConvertToApiObject(array $content): array|AbstractApiObject
    {
        $type = $content['meta']['type'] ?? null;
        $href = $content['meta']['href'] ?? null;
        if (!$type || !$href) {
            return $content;
        }

        $class = $this->isCollection($content) ?
            $this->mapping->getCollection($type) :
            $this->mapping->getObject($type);

        [$path] = Url::parsePathAndParams($href);

        return is_a($class, AbstractConcreteApiObject::class, true) ?
            new $class($this->ms, $content) :
            new $class($this->ms, $path, $type, $content);
    }

    protected function isCollection(array $content): bool
    {
        return array_key_exists('rows', $content)
            || isset($content['meta']['limit'])
            || isset($content['meta']['offset'])
            || isset($content['meta']['size'])
            || isset($content['meta']['nextHref'])
            || isset($content['meta']['previousHref']);
    }

    protected function convertToStdClass(array|AbstractApiObject $content): AbstractApiObject|stdClass|array
    {
        if (is_a($content, AbstractApiObject::class)) {
            return $content;
        }

        if (array_is_list($content)) {
            $array = [];
            foreach ($content as $item) {
                $array[] = $this->convertToStdClass($item);
            }

            return $array;
        }

        $object = new stdClass();
        foreach ($content as $key => $value) {
            if (is_array($value)) {
                $value = $this->convertToStdClass($value);
            }
            $object->{$key} = $value;
        }

        return $object;
    }
}
