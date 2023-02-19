<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Http\ApiClient;
use RuntimeException;

abstract class AbstractSegmentCommon extends AbstractBuilder
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
            throw new RuntimeException('Passed $segment cannot be empty');
        }

        return [...$this->prevPath, $this->segment];
    }
}
