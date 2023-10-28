<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Files;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Файлов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-fajly
 *
 * @implements AbstractNestedCollection<Files>
 */
class FilesCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::FILES,
    ];
    public const TYPE = Type::FILES;
}
