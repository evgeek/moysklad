<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\Formatters\JsonFormatterInterface;

class AbstractObjectBuilder
{
    public function __construct(protected readonly JsonFormatterInterface $formatter)
    {
    }
}
