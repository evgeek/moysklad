<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Traits;

use Evgeek\Moysklad\Api\Query\DebugBuilder;
use Evgeek\Moysklad\Services\Url;

trait DebugRecordTrait
{
    public function debug(): DebugBuilder
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);

        return new DebugBuilder($this->ms->getApiClient(), $path, $params);
    }
}
