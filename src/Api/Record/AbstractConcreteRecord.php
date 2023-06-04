<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record;

use Evgeek\Moysklad\MoySklad;

abstract class AbstractConcreteRecord extends AbstractUnknownRecord
{
    public const PATH = [];
    public const TYPE = '';

    final public function __construct(MoySklad $ms, mixed $content = [])
    {
        parent::__construct($ms, static::PATH, static::TYPE, $content);
    }
}
