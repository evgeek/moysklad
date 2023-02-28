<?php

declare(strict_types=1);

namespace Evgeek\Moysklad;

use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\ApiObjects\Builders\ApiEntityMaker;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\GuzzleSenderFactory;
use Evgeek\Moysklad\Http\RequestSenderFactoryInterface;

class MoySklad
{
    private ApiClient $api;
    private static JsonFormatterInterface $globalFormatter;

    /**
     * @param array                         $credentials          ['login', 'password'] or ['token']
     * @param JsonFormatterInterface        $formatter            API response formatter
     * @param RequestSenderFactoryInterface $requestSenderFactory PSR-7 client factory
     */
    public function __construct(
        array $credentials,
        private readonly JsonFormatterInterface $formatter = new StdClassFormat(),
        RequestSenderFactoryInterface $requestSenderFactory = new GuzzleSenderFactory(),
    ) {
        static::$globalFormatter = $this->formatter;
        $this->api = new ApiClient($credentials, $this->formatter, $requestSenderFactory->make());
    }

    /**
     * Query builder
     * <code>
     * $products = $ms->query()
     *  ->endpoint('entity')
     *  ->product()
     *  ->get();
     * </code>
     */
    public function query(): Query
    {
        return new Query($this->api);
    }

    public function make(): ApiEntityMaker
    {
        return new ApiEntityMaker($this->formatter);
    }

    public static function getGlobalFormatter(): JsonFormatterInterface
    {
        return static::$globalFormatter = static::$globalFormatter ?? new StdClassFormat();
    }
}
