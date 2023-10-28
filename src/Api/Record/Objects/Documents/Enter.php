<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\EnterCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Оприходование
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-oprihodowanie
 *
 * @implements AbstractConcreteObject<EnterCollection>
 */
class Enter extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::ENTER,
    ];
    public const TYPE = Type::ENTER;
}
