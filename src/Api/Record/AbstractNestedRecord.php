<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record;

use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\NestedRecordHelper;
use Evgeek\Moysklad\Services\RecordMappingHelper;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

abstract class AbstractNestedRecord extends AbstractUnknownRecord
{
    public const PATH = [];
    public const TYPE = '';

    final public function __construct(MoySklad $ms, ObjectInterface|array|string $parent, mixed $content = [])
    {
        $path = array_merge(NestedRecordHelper::getParentPath($ms, $parent), static::PATH);

        parent::__construct($ms, $path, static::TYPE, $content);
    }
}
