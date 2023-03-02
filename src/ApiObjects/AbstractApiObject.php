<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects;

use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\MoySklad;
use stdClass;

abstract class AbstractApiObject extends stdClass
{
    public function __construct(mixed $content = [], JsonFormatterInterface $formatter = null)
    {
        $this->formatContent($content, $formatter);
    }

    public function __get(string $name)
    {
        return property_exists($this, $name) ? $this->{$name} : null;
    }

    abstract protected function createMeta(mixed $value): self;

    protected function formatContent(mixed $content, ?JsonFormatterInterface $formatter): void
    {
        $formatter = $formatter ?? MoySklad::getFormatter();
        $apiObjectFormatter = is_a($formatter, ApiObjectFormatter::class) ?
            $formatter :
            new ApiObjectFormatter();

        $arrayContent = (new ArrayFormat())->encode($formatter->decode($content));

        foreach ($arrayContent as $key => $value) {
            if ($key === 'group') {
                $a = 5;
            }
            if ($key === 'meta') {
                $this->{$key} = $this->createMeta($value);
                continue;
            }

            if (is_array($value)) {
                $this->{$key} = $apiObjectFormatter->encodeToStdClass($value);
                continue;
            }

            $this->{$key} = $value;
        }
    }
}
