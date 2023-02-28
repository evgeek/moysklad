<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

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
    public function __construct(private readonly ApiObjectMapping $mapping = new ApiObjectMapping())
    {
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

        return $this->convertApiObjects($encodedContent);
    }

    protected function convertApiObjects(array $content)
    {
        foreach ($content as $key => $value) {
            if ($this->checkValueIsApiEntity($value)) {
                $content[$key] = $this->convertApiObjects($value);
            }
        }

        if ($type = $this->getTypeFromApiEntity($content)) {
            $class = $this->mapping->get($type);

            if ($class) {
                $content = new $class($content);
            }
        }

        return $content;
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

        return $value['meta']['type'] ?? null;
    }
}
