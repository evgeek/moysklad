<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Tools;

use Evgeek\Moysklad\ApiObjects\Objects\Customerorder;
use Evgeek\Moysklad\ApiObjects\Objects\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\Product;
use Evgeek\Moysklad\Dictionaries\Endpoint;
use Evgeek\Moysklad\Dictionaries\Entity;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

class Meta
{
    /** @deprecated */
    private static ?JsonFormatterInterface $formatter = null;

    public static function state(string $entity, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::entity([$entity, 'metadata', 'states', $guid], 'state', $formatter);
    }

    public static function service(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::entity(['service', $guid], 'service', $formatter);
    }

    public static function product(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Product::PATH, $guid], Entity::PRODUCT, $formatter);
    }

    public static function employee(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Employee::PATH, $guid], Entity::EMPLOYEE, $formatter);
    }

    public static function customerorder(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Customerorder::PATH, $guid], Entity::CUSTOMERORDER, $formatter);
    }

    public static function saleschannel(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::entity(['saleschannel', $guid], 'saleschannel', $formatter);
    }

    public static function currency(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::entity(['currency', $guid], 'currency', $formatter);
    }

    public static function store(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::entity(['store', $guid], 'store', $formatter);
    }

    public static function counterparty(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::entity(['counterparty', $guid], 'counterparty', $formatter);
    }

    public static function organization(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::entity(['organization', $guid], 'organization', $formatter);
    }

    /** @deprecated */
    public static function entity(array $path, string $type, JsonFormatterInterface $formatter = null)
    {
        return static::create([Endpoint::ENTITY, ...$path], $type, $formatter);
    }

    /**
     * @param string[] $path
     */
    public static function create(array $path, string $type, JsonFormatterInterface $formatter = null)
    {
        $formatter = $formatter ?? static::$formatter ?? new StdClassFormat();

        return $formatter->encode((new ArrayFormat())->decode([
            'href' => static::makeHref($path),
            'type' => $type,
            'mediaType' => 'application/json',
        ]));
    }

    /**
     * @deprecated
     */
    public static function setFormat(JsonFormatterInterface $formatter): void
    {
        static::$formatter = $formatter;
    }

    private static function makeHref(array $path): string
    {
        $href = Url::API;
        $path = array_values($path);
        foreach ($path as $key => $segment) {
            if (!is_string($segment)) {
                throw new InvalidArgumentException("{$key}th segment of path is not a string");
            }
            $href .= "/$segment";
        }

        return $href;
    }
}
