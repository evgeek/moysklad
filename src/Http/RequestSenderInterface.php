<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface RequestSenderInterface
{
    public function send(RequestInterface $request): ResponseInterface;
}
