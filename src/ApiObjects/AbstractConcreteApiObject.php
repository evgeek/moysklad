<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects;

use Evgeek\Moysklad\MoySklad;

abstract class AbstractConcreteApiObject extends AbstractUnknownApiObject
{
    public const PATH = [];
    public const TYPE = '';

    public function __construct(MoySklad $ms, mixed $content = [])
    {
        parent::__construct($ms, static::PATH, static::TYPE, $content);
    }
}
