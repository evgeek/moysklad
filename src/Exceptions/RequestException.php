<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Exceptions;

use Evgeek\Moysklad\Formatters\StdClassFormat;
use Exception;
use Psr\Http\Message\ResponseInterface;
use stdClass;

/**
 * HTTP request sender exception
 */
class RequestException extends Exception
{
    private ?stdClass $content;
    private bool $contentResolved = false;

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
    public function getContent(): ?stdClass
    {
        if ($this->contentResolved) {
            return $this->content;
        }

        $content = $this->getResponse()?->getBody()->getContents();
        $this->content = $content === null ?
            null :
            (new StdClassFormat())->encode($content);
        $this->contentResolved = true;

        return $this->content;
    }
}
