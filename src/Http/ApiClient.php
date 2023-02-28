<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Services\Url;
use Generator;
use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;
use Throwable;
use UnexpectedValueException;

class ApiClient
{
    private array $headers = ['Content-Type' => 'application/json'];

    public function __construct(
        array $credentials,
        private readonly JsonFormatterInterface $formatter,
        private readonly RequestSenderInterface $requestSender,
    ) {
        $this->addCredentialsToHeaders($credentials);
    }

    /**
     * @throws RequestException
     */
    public function send(Payload $payload)
    {
        return $this->formatter->encode($this->sendRequest($payload));
    }

    public function debug(Payload $payload)
    {
        $url = Url::make($payload);
        $debug = [
            'method' => $payload->method->value,
            'url' => urldecode($url),
            'url_encoded' => $url,
            'headers' => $this->headers,
            'body' => (new ArrayFormat())->encode($this->formatter->decode($payload->body)),
        ];

        return $this->formatter->encode((new ArrayFormat())->decode($debug));
    }

    /**
     * @throws RequestException
     */
    public function getGenerator(Payload $payload): Generator
    {
        do {
            $content = (new ArrayFormat())->encode($this->sendRequest($payload));
            if (!array_key_exists('rows', $content)) {
                throw new UnexpectedValueException("Response is non-iterable (missed 'rows' property)");
            }
            $limit = $content['meta']['limit'] ?? null;
            $offset = $content['meta']['offset'] ?? null;
            if ($limit === null || $offset === null) {
                throw new UnexpectedValueException("Response is non-iterable (missed 'limit' or 'offset' property)");
            }

            foreach ($content['rows'] as $row) {
                yield $this->formatter->encode((new ArrayFormat())->decode($row));
            }

            $next = $content['meta']['nextHref'] ?? null;

            $params = $payload->params;
            $params['offset'] = $offset + $limit;
            $payload = new Payload($payload->method, $payload->path, $params, $payload->body);
        } while ($next !== null);
    }

    /**
     * @throws RequestException
     */
    private function sendRequest(Payload $payload): string
    {
        $uri = Url::make($payload);
        $body = $this->formatter->decode($payload->body);
        $request = new Request($payload->method->value, $uri, $this->headers, $body);

        try {
            return $this->requestSender
                ->send($request)
                ->getBody()
                ->getContents();
        } catch (Throwable $e) {
            throw new RequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    private function addCredentialsToHeaders(array $credentials): void
    {
        if (!array_is_list($credentials)) {
            throw new InvalidArgumentException('Credentials must be a list array');
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

        throw new InvalidArgumentException('The size of the credential array must be equal to 1 for a token ' .
            "or 2 for a login-password, $count provided");
    }
}
