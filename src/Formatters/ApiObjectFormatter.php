<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\ApiObjects\Meta;
use Evgeek\Moysklad\ApiObjects\Objects\AbstractObject;
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
     * @return AbstractObject|array<AbstractObject>|array<stdClass>|stdClass
     */
    public function encode(string $content): AbstractObject|stdClass|array
    {
        if ($content === '') {
            return new stdClass();
        }

        try {
            $encodedContent = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            $this->throwContentIsNotValidJsonObject($content);
        }

        if (!is_a($encodedContent, stdClass::class) && !is_array($encodedContent)) {
            $this->throwContentIsNotValidJsonObject($content);
        }

        $array = $this->encodeArray2($encodedContent);

        return $this->convertToStdClass($array);
    }

    public function encodeArray2(array $content): array|AbstractObject
    {
        $content = $this->tryConvertToApiObject($content);
        if (is_subclass_of($content, AbstractObject::class)) {
            return $content;
        }

        foreach ($content as $key => $value) {
            if($key === 'meta') {
                $content[$key] = new Meta($value);
                continue;
            }

            $content[$key] = $this->tryConvertToApiObject($value);

            if (is_array($content[$key])) {
                $content[$key] = $this->encodeArray2($value);
            }
        }

        return $content;
    }

    private function tryConvertToApiObject(mixed $content): mixed
    {
        if ($type = $this->getTypeFromApiEntity($content)) {
            $class = $this->mapping->get($type);

            if ($class) {
                return new $class($content);
            }
        }

        return $content;
    }

    protected function convertToStdClass(array|AbstractObject $array): AbstractObject|stdClass|array
    {
        if (is_array($array) && array_is_list($array)) {
            return $array;
        }

        $object = new stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->convertToStdClass($value);
            }
            $object->{$key} = $value;
        }
        return $object;
    }

    protected function checkValueIsApiEntity(mixed $value): bool
    {
        return is_array($value)
            && array_key_exists('meta', $value)
            && !array_key_exists('rows', $value);
    }

    protected function getTypeFromApiEntity(mixed $value): ?string
    {
        if (!$this->checkValueIsApiEntity($value)) {
            return null;
        }

        $meta = $value['meta'];

        return is_a($meta, Meta::class) ? $meta?->type : $meta['type'];
    }
}
