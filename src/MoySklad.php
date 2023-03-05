<?php

declare(strict_types=1);

namespace Evgeek\Moysklad;

use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\ApiObjects\Builders\ApiBuilder;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Formatters\WithMoySkladInterface;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\GuzzleSenderFactory;
use Evgeek\Moysklad\Http\RequestSenderFactoryInterface;
use Evgeek\Moysklad\Meta\MetaMaker;

class MoySklad
{
    private ApiClient $api;

    /**
     * @param array                         $credentials          ['login', 'password'] or ['token']
     * @param JsonFormatterInterface        $formatter            API response formatter
     * @param RequestSenderFactoryInterface $requestSenderFactory PSR-7 client factory
     */
    public function __construct(
        array                                   $credentials,
        private readonly JsonFormatterInterface $formatter = new StdClassFormat(),
        RequestSenderFactoryInterface           $requestSenderFactory = new GuzzleSenderFactory(),
    ) {
        if (is_a($this->formatter, WithMoySkladInterface::class)) {
            $this->formatter->setMoySklad($this);
        }

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

    public function apiObject(): ApiBuilder
    {
        return new ApiBuilder($this);
    }

    public function meta(): MetaMaker
    {
        return new MetaMaker($this->formatter);
    }

    public function getApiClient(): ApiClient
    {
        return $this->api;
    }
}
