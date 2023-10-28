<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPositionResult;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Продуктов Техоперации
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-tehoperaciq-produkty-tehoperacii
 *
 * @implements AbstractNestedCollection<ProcessingPositionResult>
 */
class ProcessingPositionResultCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::PRODUCTS,
    ];
    public const TYPE = Type::PROCESSINGPOSITIONRESULT;
}
