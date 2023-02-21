<?php

declare(strict_types=1);

namespace Evgeek\Moysklad;

use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\GuzzleSender;
use Evgeek\Moysklad\Http\RequestSenderInterface;
use Evgeek\Moysklad\Services\Formatter;

class MoySklad
{
    private ApiClient $api;

    /**
     * @param array                                $credentials   ['login', 'password'] or ['token']
     * @param class-string<JsonFormatterInterface> $formatter     API response formatter - class name that implements JsonFormatter
     * @param RequestSenderInterface               $requestSender PSR-7 client
     */
    public function __construct(
        array $credentials,
        string $formatter = Formatter::DEFAULT,
        RequestSenderInterface $requestSender = new GuzzleSender(),
    ) {
        $this->api = new ApiClient($credentials, Formatter::resolve($formatter), $requestSender);
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
