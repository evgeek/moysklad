<?php

declare(strict_types=1);

namespace Evgeek\Moysklad;

use Evgeek\Moysklad\Api\Methods\Endpoints\Audit;
use Evgeek\Moysklad\Api\Methods\Endpoints\CommonEndpoint;
use Evgeek\Moysklad\Api\Methods\Endpoints\Entity;
use Evgeek\Moysklad\Api\Methods\Endpoints\Notification;
use Evgeek\Moysklad\Api\Methods\Endpoints\Report;
use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Exceptions\ConfigException;
use Evgeek\Moysklad\Factories\FormatHandlerFactory;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\GuzzleSender;
use Evgeek\Moysklad\Http\RequestSenderInterface;
use JetBrains\PhpStorm\Pure;

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
     * Generic endpoint method
     * <code>
     * $products = $ms->endpoint('entity')
     *      ->product()
     *      ->get();
     * </code>
     */
    #[Pure]
    public function endpoint(string $endpoint): CommonEndpoint
    {
        return new CommonEndpoint($this->api, null, $endpoint);
    }

    /**
     * Entities and documents endpoint
     * <code>
     * $products = $ms->entity()
     *      ->product()
     *      ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/
     */
    #[Pure]
    public function entity(): Entity
    {
        return new Entity($this->api, null);
    }

    /**
     * Reports endpoint
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/reports/#otchety
     */
    #[Pure]
    public function report(): Report
    {
        return new Report($this->api, null);
    }

    /**
     * Audit endpoint
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/other/#audit
     */
    #[Pure]
    public function audit(): Audit
    {
        return new Audit($this->api, null);
    }

    /**
     * Notifications endpoint
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/other/#uwedomleniq
     */
    #[Pure]
    public function notification(): Notification
    {
        return new Notification($this->api, null);
    }
}
