<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Image;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Изображений
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-izobrazhenie
 *
 * @implements AbstractNestedCollection<Image>
 */
class ImageCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::IMAGES,
    ];
    public const TYPE = Type::IMAGE;
}
