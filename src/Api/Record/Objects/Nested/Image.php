<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\ImageCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Изображение
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-izobrazhenie
 *
 * @implements AbstractNestedObject<ImageCollection>
 */
class Image extends AbstractNestedObject
{
    public const PATH = [
        Segment::IMAGES,
    ];
    public const TYPE = Type::IMAGE;
}
