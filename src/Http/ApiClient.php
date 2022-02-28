<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\ConfigException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Handlers\Format\ArrayFormatHandler;
use Evgeek\Moysklad\Handlers\Format\FormatHandlerInterface;
use Evgeek\Moysklad\Services\Url;
use GuzzleHttp\Psr7\Request;
use SplQueue;
use Throwable;

class ApiClient
{
    private array $headers = ['Content-Type' => 'application/json'];

    /**
     * @throws ConfigException
     */
    public function __construct(
        array $credentials,
        private readonly FormatHandlerInterface $formatter,
        private readonly RequestSenderInterface $requestSender,
    )
    {
        $this->addCredentialsToHeaders($credentials);
    }

    /**
     * @param array $credentials
     * @return void
     * @throws ConfigException
     */
    private function addCredentialsToHeaders(array $credentials): void
    {
        if (!array_is_list($credentials)) {
            throw new ConfigException('Credentials must be a list array');
        }

        $count = count($credentials);
        if ($count === 1) {
            $this->headers['Authorization'] = 'Bearer '.$credentials[0];
            return;
        }

        if ($count === 2) {
            $this->headers['Authorization'] = 'Basic '.base64_encode($credentials[0].':'.$credentials[1]);
            return;
        }

        throw new ConfigException("The size of the credential array must be equal to 1 for a token " .
            "or 2 for a login-password. $count provided.");
    }

    /**
     * @throws FormatException
     * @throws ApiException
     */
    public function send(SplQueue $payloadList): object|array|string
    {
        /** @var Payload $payload */
        $payload = $payloadList->top();

        $body = $payload->body === null ? '' : $this->formatter::encode($payload->body);
        $request = new Request($payload->method->name, Url::make($payloadList), $this->headers, $body);

        try {
            $content = $this->requestSender
                ->send($request)
                ->getBody()
                ->getContents();
        } catch (Throwable $e) {
            throw new ApiException($e->getMessage(), $e->getCode());
        }

        return $this->formatter::decode($content);
    }

    /**
     * @throws FormatException
     */
    public function debug(SplQueue $payloadList): object|array|string
    {
        /** @var Payload $payload */
        $payload = $payloadList->pop();

        $url = Url::make($payloadList);
        $debug = [
            'method' => $payload->method,
            'url' => urldecode($url),
            'url_encoded' => $url,
            'headers' => $this->headers,
            'body' => $payload->body === null ? '' : ArrayFormatHandler::decode($payload->body),
        ];

        return $this->formatter::decode($debug);
    }
}