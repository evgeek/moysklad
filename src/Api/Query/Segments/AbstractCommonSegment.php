<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments;

use Evgeek\Moysklad\Http\ApiClient;
use InvalidArgumentException;

abstract class AbstractCommonSegment extends AbstractSegment
{
    public function __construct(
        ApiClient $api,
        array $prevPath,
        array $params,
        protected readonly string $segment
    ) {
        parent::__construct($api, $prevPath, $params);
    }

    protected function makeCurrentPath(): array
    {
        if (!$this->segment) {
            throw new InvalidArgumentException('Passed $segment cannot be empty');
        }

        return [...$this->prevPath, $this->segment];
    }
}
