<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Tools;

use Evgeek\Moysklad\Exceptions\ConfigException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Services\Formatter;
use Evgeek\Moysklad\Services\Url;

class Meta
{
    private static ?JsonFormatterInterface $formatter = null;

    /**
     * @throws ConfigException|FormatException
     */
    public static function state(string $guid, string $entity)
    {
        return static::entity([$entity, 'metadata', 'states', $guid], 'state');
    }

    /**
     * @throws ConfigException|FormatException
     */
    public static function service(string $guid)
    {
        return static::entity(['service', $guid], 'service');
    }

    /**
     * @throws ConfigException|FormatException
     */
    public static function product(string $guid)
    {
        return static::entity(['product', $guid], 'product');
    }

    /**
     * @throws ConfigException|FormatException
     */
    public static function saleschannel(string $guid)
    {
        return static::entity(['saleschannel', $guid], 'saleschannel');
    }

    /**
     * @throws ConfigException|FormatException
     */
    public static function currency(string $guid)
    {
        return static::entity(['currency', $guid], 'currency');
    }

    /**
     * @throws ConfigException|FormatException
     */
    public static function store(string $guid)
    {
        return static::entity(['store', $guid], 'store');
    }

    /**
     * @throws ConfigException|FormatException
     */
    public static function counterparty(string $guid)
    {
        return static::entity(['counterparty', $guid], 'counterparty');
    }

    /**
     * @throws ConfigException|FormatException
     */
    public static function organization(string $guid)
    {
        return static::entity(['organization', $guid], 'organization');
    }

    /**
     * @throws ConfigException|FormatException
     */
    public static function entity(array $path, string $type)
    {
        return static::create(['entity', ...$path], $type);
    }

    /**
     * @throws ConfigException|FormatException
     */
    public static function create(array $path, string $type)
    {
        static::$formatter = static::$formatter ?? Formatter::resolveDefault();

        $href = Url::API;
        foreach ($path as $slug) {
            $href .= "/$slug";
        }

        return static::$formatter::encode(ArrayFormat::decode([
            'href' => $href,
            'type' => $type,
            'mediaType' => 'application/json',
        ]));
    }

    /**
     * @param class-string<JsonFormatterInterface> $formatter
     *
     * @throws ConfigException
     */
    public static function setFormat(string $formatter): void
    {
        static::$formatter = Formatter::resolve($formatter);
    }
}
