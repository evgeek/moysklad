<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\Api\Record\AbstractConcreteRecord;
use Evgeek\Moysklad\Api\Record\AbstractNestedRecord;
use Evgeek\Moysklad\Api\Record\AbstractRecord;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\NestedRecordHelper;
use Evgeek\Moysklad\Services\RecordHelper;
use Evgeek\Moysklad\Services\Url;
use stdClass;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatterInterface<stdClass>
 */
class RecordFormat extends AbstractMultiDecoder implements WithMoySkladInterface
{
    protected MoySklad $ms;

    public function __construct(private readonly RecordMapping $mapping = new RecordMapping())
    {
    }

    public function setMoySklad(MoySklad $ms): static
    {
        $this->ms = $ms;

        return $this;
    }

    public function getMapping(): RecordMapping
    {
        return $this->mapping;
    }

    /**
     * @return AbstractRecord|array<AbstractRecord>|array<stdClass>|stdClass
     */
    public function encode(string $content): AbstractRecord|stdClass|array
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

    public function encodeToStdClass(array $content): AbstractRecord|stdClass|array
    {
        $result = $this->encodeArray($content);

        return $this->convertToStdClass($result);
    }

    protected function encodeArray(array $content): array|AbstractRecord
    {
        $object = $this->tryConvertToRecord($content);
        if (is_a($object, AbstractRecord::class)) {
            return $object;
        }

        foreach ($content as $key => $value) {
            $content[$key] = is_array($value) ?
                $this->tryConvertToRecord($value) :
                $value;

            if (is_array($content[$key])) {
                $content[$key] = $this->encodeArray($value);
            }
        }

        return $content;
    }

    protected function tryConvertToRecord(array $content): AbstractRecord|array
    {
        $type = $content['meta']['type'] ?? null;
        $href = $content['meta']['href'] ?? null;
        if (!$type || !$href) {
            return $content;
        }

        $class = RecordHelper::isCollection($this->ms, $content) ?
            $this->mapping->getCollection($type) :
            $this->mapping->getObject($type);

        [$path] = Url::parsePathAndParams($href);

        if (is_a($class, AbstractConcreteRecord::class, true)) {
            return new $class($this->ms, $content);
        }

        if (is_a($class, AbstractNestedRecord::class, true)) {
            $parentPath = NestedRecordHelper::clearParentPath($path, $class::PATH);

            return new $class($this->ms, $parentPath, $content);
        }

        // UnknownObject | UnknownCollection
        return new $class($this->ms, $path, $type, $content);
    }

    protected function convertToStdClass(array|AbstractRecord $content): AbstractRecord|stdClass|array
    {
        if (is_a($content, AbstractRecord::class)) {
            return $content;
        }

        if (array_is_list($content)) {
            $array = [];
            foreach ($content as $item) {
                $array[] = is_array($item) ?
                    $this->convertToStdClass($item) :
                    $item;
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
