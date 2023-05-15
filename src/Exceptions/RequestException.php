<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Exceptions;

use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Exception;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use Throwable;

/**
 * HTTP request sender exception
 */
class RequestException extends Exception
{
    private ?string $content;
    private bool $contentResolved = false;

    public function __construct(
        private readonly JsonFormatterInterface $formatter,
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Возвращает PSR-7 объект HTTP ответа, если он существует
     */
    public function getResponse(): ?ResponseInterface
    {
        $previous = $this->getPrevious();
        if (!$previous || !method_exists($previous, 'getResponse')) {
            return null;
        }

        $response = $previous->getResponse();
        if (!is_subclass_of($response, ResponseInterface::class)) {
            return null;
        }

        return $response;
    }

    /**
     * Возвращает содержимое HTTP ответа
     */
    public function getContent(): stdClass|array|string|null
    {
        if ($this->contentResolved) {
            $this->getContentEncoded();
        }

        $this->content = $this->getResponse()?->getBody()->getContents();
        $this->contentResolved = true;

        return $this->getContentEncoded();
    }

    private function getContentEncoded(): stdClass|array|string|null
    {
        return $this->content === null ?
            null :
            $this->formatter->encode($this->content);
    }
}
