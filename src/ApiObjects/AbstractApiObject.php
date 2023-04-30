<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects;

use Evgeek\Moysklad\Formatters\AbstractMultiDecoder;
use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\MoySklad;
use stdClass;

abstract class AbstractApiObject extends stdClass
{
    protected array $contentContainer = [];

    public function __construct(protected readonly MoySklad $ms, mixed $content = [])
    {
        $this->hydrate($content);
    }

    public function __get(string $name)
    {
        return $this->contentContainer[$name] ?? null;
    }

    public function __set(string $name, mixed $value)
    {
        $this->contentContainer[$name] = $value;
    }

    public function __isset(string $name)
    {
        return array_key_exists($name, $this->contentContainer);
    }

    public function __unset(string $name)
    {
        unset($this->contentContainer[$name]);
    }

    public function toString(): string
    {
        return (new ArrayFormat())->decode($this->toArray());
    }

    public function toArray(): array
    {
        return AbstractMultiDecoder::toArray($this->contentContainer);
    }

    /**
     * @return array<stdClass>|stdClass
     */
    public function toStdClass(): array|stdClass
    {
        return (new StdClassFormat())->encode($this->toString());
    }

    protected function hydrate(mixed $content): void
    {
        $this->contentContainer = [];

        $this->hydrateAdd($content);
    }

    protected function hydrateAdd(mixed $content): void
    {
        $formatter = $this->ms->getApiClient()->getFormatter();
        $apiObjectFormatter = is_a($formatter, ApiObjectFormatter::class) ?
            $formatter :
            (new ApiObjectFormatter())->setMoySklad($this->ms);

        $arrayContent = (new ArrayFormat())->encode($formatter->decode($content));

        foreach ($arrayContent as $key => $value) {
            if (is_array($value)) {
                $this->{$key} = $apiObjectFormatter->encodeToStdClass($value);

                continue;
            }

            $this->{$key} = $value;
        }
    }
}
