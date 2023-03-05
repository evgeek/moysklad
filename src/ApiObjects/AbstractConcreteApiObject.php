<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects;

use Evgeek\Moysklad\MoySklad;

abstract class AbstractConcreteApiObject extends AbstractUnknownApiObject
{
    protected const PATH = [];
    protected const TYPE = '';

    public function __construct(MoySklad $ms, mixed $content = [])
    {
        parent::__construct($ms, static::PATH, static::TYPE, $content);
    }
}
