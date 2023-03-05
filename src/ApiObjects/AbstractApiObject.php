<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects;

use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\MoySklad;
use stdClass;

abstract class AbstractApiObject extends stdClass
{
    public function __construct(protected readonly MoySklad $ms, mixed $content = [])
    {
        $this->hydrate($content);
    }

    public function toString(): string
    {
        return $this->ms->getApiClient()->getFormatter()->decode($this);
    }

    public function toArray(): array
    {
        return (new ArrayFormat())->encode($this->toString());
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
