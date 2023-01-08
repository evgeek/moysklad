<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\ConfigException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\GeneratorException;
use Evgeek\Moysklad\Handlers\Format\ArrayFormatHandler;
use Evgeek\Moysklad\Handlers\Format\FormatHandlerInterface;
use Evgeek\Moysklad\Services\Url;
use Generator;
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
    ) {
        $this->addCredentialsToHeaders($credentials);
    }

    /**
     * @throws FormatException
     * @throws ApiException
     */
    public function send(SplQueue $payloadList): object|array|string
    {
        return $this->formatter::decode($this->sendRequest($payloadList));
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
            'method' => $payload->method->value,
            'url' => urldecode($url),
            'url_encoded' => $url,
            'headers' => $this->headers,
            'body' => $payload->body === null ? '' : ArrayFormatHandler::decode($payload->body),
        ];

        return $this->formatter::decode($debug);
    }

    /**
     * @throws FormatException
     * @throws GeneratorException
     * @throws ApiException
     */
    public function getGenerator(SplQueue $payloadList): Generator
    {
        do {
            $content = ArrayFormatHandler::decode($this->sendRequest($payloadList));
            if (!array_key_exists('rows', $content)) {
                throw new GeneratorException("Response is non-iterable (missed 'rows' property)");
            }
            $limit = $content['meta']['limit'] ?? null;
            $offset = $content['meta']['offset'] ?? null;
            if ($limit === null || $offset === null) {
                throw new GeneratorException("Response is non-iterable (missed 'limit' or 'offset' property)");
            }

            foreach ($content['rows'] as $row) {
                yield $this->formatter::decode(ArrayFormatHandler::encode($row));
            }

            $next = $content['meta']['nextHref'] ?? null;

            /** @var Payload $payload */
            $payload = $payloadList->pop();
            $params = $payload->params;
            $params['offset'] = $offset + $limit;
            $payloadList->push(new Payload($payload->method, $payload->path, $params, $payload->body));
        } while ($next !== null);
    }

    /**
     * @throws FormatException
     * @throws ApiException
     */
    private function sendRequest(SplQueue $payloadList): string
    {
        /** @var Payload $payload */
        $payload = $payloadList->top();

        $body = $payload->body === null ? '' : $this->formatter::encode($payload->body);
        $request = new Request($payload->method->value, Url::make($payloadList), $this->headers, $body);

        try {
            return $this->requestSender
                ->send($request)
                ->getBody()
                ->getContents();
        } catch (Throwable $e) {
            throw new ApiException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws ConfigException
     */
    private function addCredentialsToHeaders(array $credentials): void
    {
        if (!array_is_list($credentials)) {
            throw new ConfigException('Credentials must be a list array');
        }

        $count = count($credentials);
        if ($count === 1) {
            $this->headers['Authorization'] = 'Bearer ' . $credentials[0];

            return;
        }

        if ($count === 2) {
            $this->headers['Authorization'] = 'Basic ' . base64_encode($credentials[0] . ':' .$credentials[1]);

            return;
        }

        throw new ConfigException('The size of the credential array must be equal to 1 for a token ' .
            "or 2 for a login-password. $count provided.");
    }
}
