<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPositionResultCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Продукт Техоперации
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-tehoperaciq-produkty-tehoperacii
 *
 * @implements AbstractNestedObject<ProcessingPositionResultCollection>
 */
class ProcessingPositionResult extends AbstractNestedObject
{
    public const PATH = [
        Segment::PRODUCTS,
    ];
    public const TYPE = Type::PROCESSINGPOSITIONRESULT;
}
