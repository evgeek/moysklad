<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Meta;

use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Tools\Meta;

class MetaMaker
{
    public function __construct(protected readonly JsonFormatterInterface $formatter)
    {
    }

    public function product(string $guid)
    {
        return Meta::product($guid, $this->formatter);
    }

    public function employee(string $guid)
    {
        return Meta::employee($guid, $this->formatter);
    }

    public function create(array $path, string $type)
    {
        return Meta::create($path, $type, $this->formatter);
    }
}
