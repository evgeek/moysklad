<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPositionMaterial;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Материалов Техоперации
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-tehoperaciq-material-tehoperacii
 *
 * @implements AbstractNestedCollection<ProcessingPositionMaterial>
 */
class ProcessingPositionMaterialCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::MATERIALS,
    ];
    public const TYPE = Type::PROCESSINGPOSITIONMATERIAL;
}
