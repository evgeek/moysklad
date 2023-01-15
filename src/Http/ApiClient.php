<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\ConfigException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\GeneratorException;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\JsonFormatter;
use Evgeek\Moysklad\Services\Url;
use Generator;
use GuzzleHttp\Psr7\Request;
use Throwable;

class ApiClient
{
    private array $headers = ['Content-Type' => 'application/json'];

    /**
     * @throws ConfigException
     */
    public function __construct(
        array $credentials,
        private readonly JsonFormatter $formatter,
        private readonly RequestSenderInterface $requestSender,
    ) {
        $this->addCredentialsToHeaders($credentials);
    }

    /**
     * @throws FormatException
     * @throws ApiException
     */
    public function send(Payload $payload)
    {
        return $this->formatter::encode($this->sendRequest($payload));
    }

    /**
     * @throws FormatException
     */
    public function debug(Payload $payload)
    {
        $url = Url::make($payload);
        $debug = [
            'method' => $payload->method->value,
            'url' => urldecode($url),
            'url_encoded' => $url,
            'headers' => $this->headers,
            'body' => ArrayFormat::encode($this->formatter::decode($payload->body)),
        ];

        return $this->formatter::encode(ArrayFormat::decode($debug));
    }

    /**
     * @throws FormatException
     * @throws GeneratorException
     * @throws ApiException
     */
    public function getGenerator(Payload $payload): Generator
    {
        do {
            $content = ArrayFormat::encode($this->sendRequest($payload));
            if (!array_key_exists('rows', $content)) {
                throw new GeneratorException("Response is non-iterable (missed 'rows' property)");
            }
            $limit = $content['meta']['limit'] ?? null;
            $offset = $content['meta']['offset'] ?? null;
            if ($limit === null || $offset === null) {
                throw new GeneratorException("Response is non-iterable (missed 'limit' or 'offset' property)");
            }

            foreach ($content['rows'] as $row) {
                yield $this->formatter::encode(ArrayFormat::decode($row));
            }

            $next = $content['meta']['nextHref'] ?? null;

            $params = $payload->params;
            $params['offset'] = $offset + $limit;
            $payload = new Payload($payload->method, $payload->url, $params, $payload->body);
        } while ($next !== null);
    }

    /**
     * @throws FormatException
     * @throws ApiException
     */
    private function sendRequest(Payload $payload): string
    {
        $body = $payload->body === null ? '' : $this->formatter::decode($payload->body);
        $request = new Request($payload->method->value, Url::make($payload), $this->headers, $body);

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
