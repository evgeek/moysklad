<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\UnknownCollection;
use Evgeek\Moysklad\ApiObjects\Objects\UnknownObject;
use Evgeek\Moysklad\MoySklad;
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

    public function __construct(private readonly ApiObjectMapping $mapping = new ApiObjectMapping()) {}

    public function setMoySklad(MoySklad $ms): static
    {
        $this->ms = $ms;

        return $this;
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
        if (is_subclass_of($object, AbstractApiObject::class)) {
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
        if (!$type) {
            return $content;
        }

        $class = array_key_exists('rows', $content) ?
            ($this->mapping->getContainer($type) ?? UnknownCollection::class) :
            ($this->mapping->getObject($type) ?? UnknownObject::class);

        return new $class($this->ms, $content);
    }

    protected function convertToStdClass(array|AbstractApiObject $content): AbstractApiObject|stdClass|array
    {
        if (is_subclass_of($content, AbstractApiObject::class)) {
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
