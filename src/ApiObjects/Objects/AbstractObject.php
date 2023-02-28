<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\StdClassFormat;

/**
 * @property string $id
 */
class AbstractObject
{
    private array $content;

    public function __construct(mixed $content = [], private readonly JsonFormatterInterface $formatter = new StdClassFormat())
    {
        $this->content = (new ArrayFormat())->encode($this->formatter->decode($content));
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
