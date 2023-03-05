<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Meta;

use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Tools\Meta;

class MetaMaker
{
    public function __construct(protected readonly JsonFormatterInterface $formatter) {}

    public function create(array $path, string $type)
    {
        return Meta::create($path, $type, $this->formatter);
    }
}
