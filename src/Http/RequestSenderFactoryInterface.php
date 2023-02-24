<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

interface RequestSenderFactoryInterface
{
    public function make(): RequestSenderInterface;
}
