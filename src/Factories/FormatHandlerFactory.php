<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Factories;

use Evgeek\Moysklad\Enums\Format;
use Evgeek\Moysklad\Handlers\Format\ArrayFormatHandler;
use Evgeek\Moysklad\Handlers\Format\FormatHandlerInterface;
use Evgeek\Moysklad\Handlers\Format\ObjectFormatHandler;
use Evgeek\Moysklad\Handlers\Format\StringFormatHandler;

class FormatHandlerFactory
{
    public static function create(Format $format): FormatHandlerInterface
    {
        return match ($format) {
            Format::ARRAY => new ArrayFormatHandler(),
            Format::STRING => new StringFormatHandler(),
            Format::OBJECT => new ObjectFormatHandler(),
            default => null,
        };
    }
}
