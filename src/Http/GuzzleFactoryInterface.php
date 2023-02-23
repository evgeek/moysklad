<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use GuzzleHttp\Client;

interface GuzzleFactoryInterface
{
    public function make(): Client;
}
