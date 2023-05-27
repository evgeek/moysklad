<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\MoySklad;

final class ApiObjectHelper
{
    public static function isCollection(MoySklad $ms, mixed $content): bool
    {
        $formatter = $ms->getFormatter();
        $arrayContent = (new ArrayFormat())->encode($formatter->decode($content));

        return array_key_exists('rows', $arrayContent)
            || isset($arrayContent['meta']['limit'])
            || isset($arrayContent['meta']['offset'])
            || isset($arrayContent['meta']['size'])
            || isset($arrayContent['meta']['nextHref'])
            || isset($arrayContent['meta']['previousHref']);
    }
}
