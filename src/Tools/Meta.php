<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Tools;

use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use InvalidArgumentException;

class Meta
{
    private static JsonFormatterInterface $formatter;

    public static function state(string $guid, string $entity)
    {
        return static::entity([$entity, 'metadata', 'states', $guid], 'state');
    }

    public static function service(string $guid)
    {
        return static::entity(['service', $guid], 'service');
    }

    public static function product(string $guid)
    {
        return static::entity(['product', $guid], 'product');
    }

    public static function saleschannel(string $guid)
    {
        return static::entity(['saleschannel', $guid], 'saleschannel');
    }

    public static function currency(string $guid)
    {
        return static::entity(['currency', $guid], 'currency');
    }

    public static function store(string $guid)
    {
        return static::entity(['store', $guid], 'store');
    }

    public static function counterparty(string $guid)
    {
        return static::entity(['counterparty', $guid], 'counterparty');
    }

    public static function organization(string $guid)
    {
        return static::entity(['organization', $guid], 'organization');
    }

    public static function entity(array $path, string $type)
    {
        return static::create(['entity', ...$path], $type);
    }

    /**
     * @param string[] $path
     */
    public static function create(array $path, string $type)
    {
        static::initFormatter();

        return static::$formatter::encode(ArrayFormat::decode([
            'href' => static::makeHref($path),
            'type' => $type,
            'mediaType' => 'application/json',
        ]));
    }

    public static function setFormat(JsonFormatterInterface $formatter): void
    {
        static::$formatter = $formatter;
    }

    private static function initFormatter(): void
    {
        static::$formatter = static::$formatter ?? new StdClassFormat();
    }

    private static function makeHref(array $path): string
    {
        $href = 'https://online.moysklad.ru/api/remap/1.2';
        foreach ($path as $key => $segment) {
            if (!is_string($segment)) {
                throw new InvalidArgumentException("{$key}th segment of path is not a string");
            }
            $href .= "/$segment";
        }

        return $href;
    }
}
