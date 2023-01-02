<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Tools;

use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Factories\FormatHandlerFactory;
use Evgeek\Moysklad\Handlers\Format\FormatHandlerInterface;
use Evgeek\Moysklad\Services\Url;
use JetBrains\PhpStorm\ArrayShape;

class Meta
{
    private static Format $format = Format::OBJECT;
    private static ?FormatHandlerInterface $formatter = null;

    /**
     * @throws FormatException
     */
    #[ArrayShape(['href' => 'string', 'type' => 'string', 'mediaType' => 'string'])]
    public static function state(string $guid): object|array|string
    {
        return static::entity(['customerorder', 'metadata', 'states', $guid], 'state');
    }

    /**
     * @throws FormatException
     */
    #[ArrayShape(['href' => 'string', 'type' => 'string', 'mediaType' => 'string'])]
    public static function service(string $guid): object|array|string
    {
        return static::entity(['service', $guid], 'service');
    }

    /**
     * @throws FormatException
     */
    #[ArrayShape(['href' => 'string', 'type' => 'string', 'mediaType' => 'string'])]
    public static function product(string $guid): object|array|string
    {
        return static::entity(['product', $guid], 'product');
    }

    /**
     * @throws FormatException
     */
    #[ArrayShape(['href' => 'string', 'type' => 'string', 'mediaType' => 'string'])]
    public static function saleschannel(string $guid): object|array|string
    {
        return static::entity(['saleschannel', $guid], 'saleschannel');
    }

    /**
     * @throws FormatException
     */
    #[ArrayShape(['href' => 'string', 'type' => 'string', 'mediaType' => 'string'])]
    public static function currency(string $guid): object|array|string
    {
        return static::entity(['currency', $guid], 'currency');
    }

    /**
     * @throws FormatException
     */
    #[ArrayShape(['href' => 'string', 'type' => 'string', 'mediaType' => 'string'])]
    public static function store(string $guid): object|array|string
    {
        return static::entity(['store', $guid], 'store');
    }

    /**
     * @throws FormatException
     */
    #[ArrayShape(['href' => 'string', 'type' => 'string', 'mediaType' => 'string'])]
    public static function counterparty(string $guid): object|array|string
    {
        return static::entity(['counterparty', $guid], 'counterparty');
    }

    /**
     * @throws FormatException
     */
    #[ArrayShape(['href' => 'string', 'type' => 'string', 'mediaType' => 'string'])]
    public static function organization(string $guid): object|array|string
    {
        return static::entity(['organization', $guid], 'organization');
    }

    /**
     * @throws FormatException
     */
    #[ArrayShape(['href' => 'string', 'type' => 'string', 'mediaType' => 'string'])]
    public static function entity(array $path, string $type): object|array|string
    {
        return static::create(['entity', ...$path], $type);
    }

    /**
     * @throws FormatException
     */
    #[ArrayShape(['href' => 'string', 'type' => 'string', 'mediaType' => 'string'])]
    public static function create(array $path, string $type): object|array|string
    {
        static::$formatter = static::$formatter ?? FormatHandlerFactory::create(static::$format);

        $href = Url::URL;
        foreach ($path as $slug) {
            $href .= "/{$slug}";
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
