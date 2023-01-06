<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Tools;

use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Factories\FormatHandlerFactory;
use Evgeek\Moysklad\Handlers\Format\FormatHandlerInterface;
use Evgeek\Moysklad\Services\Url;

class Meta
{
    private static Format $format = Format::OBJECT;
    private static ?FormatHandlerInterface $formatter = null;

    /**
     * @throws FormatException
     */
    public static function state(string $guid, string $entity): object|array|string
    {
        return static::entity([$entity, 'metadata', 'states', $guid], 'state');
    }

    /**
     * @throws FormatException
     */
    public static function service(string $guid): object|array|string
    {
        return static::entity(['service', $guid], 'service');
    }

    /**
     * @throws FormatException
     */
    public static function product(string $guid): object|array|string
    {
        return static::entity(['product', $guid], 'product');
    }

    /**
     * @throws FormatException
     */
    public static function saleschannel(string $guid): object|array|string
    {
        return static::entity(['saleschannel', $guid], 'saleschannel');
    }

    /**
     * @throws FormatException
     */
    public static function currency(string $guid): object|array|string
    {
        return static::entity(['currency', $guid], 'currency');
    }

    /**
     * @throws FormatException
     */
    public static function store(string $guid): object|array|string
    {
        return static::entity(['store', $guid], 'store');
    }

    /**
     * @throws FormatException
     */
    public static function counterparty(string $guid): object|array|string
    {
        return static::entity(['counterparty', $guid], 'counterparty');
    }

    /**
     * @throws FormatException
     */
    public static function organization(string $guid): object|array|string
    {
        return static::entity(['organization', $guid], 'organization');
    }

    /**
     * @throws FormatException
     */
    public static function entity(array $path, string $type): object|array|string
    {
        return static::create(['entity', ...$path], $type);
    }

    /**
     * @throws FormatException
     */
    public static function create(array $path, string $type): object|array|string
    {
        static::$formatter = static::$formatter ?? FormatHandlerFactory::create(static::$format);

        $href = Url::URL;
        foreach ($path as $slug) {
            $href .= "/$slug";
        }

        return static::$formatter::decode([
            'href' => $href,
            'type' => $type,
            'mediaType' => 'application/json',
        ]);
    }

    public static function setFormat(Format $format): void
    {
        static::$formatter = FormatHandlerFactory::create($format);
    }
}
