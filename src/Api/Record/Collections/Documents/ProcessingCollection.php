<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Documents;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Processing;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Техопераций
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-tehoperaciq
 *
 * @implements AbstractConcreteCollection<Processing>
 */
class ProcessingCollection extends AbstractDocumentCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PROCESSING,
    ];
    public const TYPE = Type::PROCESSING;
}
