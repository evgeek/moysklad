<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Enter;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Оприходований
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-oprihodowanie
 *
 * @implements AbstractConcreteCollection<Enter>
 */
class EnterCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::ENTER,
    ];
    public const TYPE = Type::ENTER;
}
