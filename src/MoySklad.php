<?php

declare(strict_types=1);

namespace Evgeek\Moysklad;

use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\GuzzleSenderFactory;
use Evgeek\Moysklad\Http\RequestSenderFactoryInterface;

class MoySklad
{
    private ApiClient $api;

    /**
     * @param array                         $credentials          ['login', 'password'] or ['token']
     * @param JsonFormatterInterface        $formatter            API response formatter
     * @param RequestSenderFactoryInterface $requestSenderFactory PSR-7 client factory
     */
    public function __construct(
        array $credentials,
        JsonFormatterInterface $formatter = new StdClassFormat(),
        RequestSenderFactoryInterface $requestSenderFactory = new GuzzleSenderFactory(),
    ) {
        $this->api = new ApiClient($credentials, $formatter, $requestSenderFactory->make());
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
}
