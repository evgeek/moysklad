<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\MoySklad;

/**
 * @property string $id
 */
class AbstractObject
{
    private array $content;

    public function __construct(mixed $content = [], JsonFormatterInterface $formatter = null)
    {
        $this->content = $this->formatContent($content, $formatter);
    }

    private function formatContent(mixed $content, ?JsonFormatterInterface $formatter): array
    {
        $formatter = $formatter ?? MoySklad::getFormatter();
        $apiObjectFormatter = is_a($formatter, ApiObjectFormatter::class) ?
            $formatter :
            new ApiObjectFormatter(ApiObjectFormatter::getMapping());

        $arrayContent = (new ArrayFormat())->encode($formatter->decode($content));

        foreach ($arrayContent as $key => $value) {
            if (is_array($value)) {
                $arrayContent[$key] = $apiObjectFormatter->encodeArray($value);
            }
        }

        return $arrayContent;
    }

    public function __toString(): string
    {
        return (new ArrayFormat())->decode($this->content);
    }

    public function __get(string $name): mixed
    {
        return $this->content[$name] ?? null;
    }

    public function __set(string $name, mixed $value)
    {
        $this->content[$name] = $value;
    }

    public function __isset(string $name)
    {
        return array_key_exists($name, $this->content);
    }

    public function __unset(string $name): void
    {
        unset($this->content[$name]);
    }
}
