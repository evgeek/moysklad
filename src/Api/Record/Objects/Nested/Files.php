<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\FilesCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Файл
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-fajly
 *
 * @implements AbstractNestedObject<FilesCollection>
 */
class Files extends AbstractNestedObject
{
    public const PATH = [
        Segment::FILES,
    ];
    public const TYPE = Type::FILES;
}
