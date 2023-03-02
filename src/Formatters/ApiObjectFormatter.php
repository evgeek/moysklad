<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use stdClass;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatterInterface<stdClass>
 */
class ApiObjectFormatter extends AbstractMultiDecoder
{
    private ApiObjectMapping $mapping;
    private static ApiObjectMapping $globalMapping;

    public function __construct(ApiObjectMapping $mapping = null)
    {
        $this->mapping = $mapping ?? static::getMapping();
    }

    public static function getMapping(): ApiObjectMapping
    {
        return static::$globalMapping = static::$globalMapping ?? new ApiObjectMapping();
    }

    public static function setMapping(ApiObjectMapping $mapping): void
    {
        static::$globalMapping = $mapping;
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

    public function encodeToStdClass(array $content): array|AbstractApiObject|stdClass
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
            $this->mapping->getContainer($type) :
            $this->mapping->getObject($type);

        return $class ? new $class($content) : $content;
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
