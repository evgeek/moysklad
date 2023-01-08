<?php

declare(strict_types=1);

namespace Evgeek\Moysklad;

use Evgeek\Moysklad\Api\Builders\Endpoints\Entity;
use Evgeek\Moysklad\Api\Builders\Query;
use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Exceptions\ConfigException;
use Evgeek\Moysklad\Factories\FormatHandlerFactory;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\GuzzleSender;
use Evgeek\Moysklad\Http\RequestSenderInterface;

class MoySklad
{
    private ApiClient $api;

    /**
     * @param array                  $credentials   ['login', 'password'] or ['token']
     * @param Format                 $format        object, array or string
     * @param RequestSenderInterface $requestSender PSR-7 client
     *
     * @throws ConfigException
     */
    public function __construct(
        array $credentials,
        Format $format = Format::OBJECT,
        RequestSenderInterface $requestSender = new GuzzleSender(),
    ) {
        $this->api = new ApiClient($credentials, FormatHandlerFactory::create($format), $requestSender);
    }

    /**
     * Query builder
     * <code>
     * $products = $ms->query()
     *      ->endpoint('entity')
     *      ->product()
     *      ->get();
     * </code>
     */
    public function query(): Query
    {
        return new Query($this->api);
    }
}
