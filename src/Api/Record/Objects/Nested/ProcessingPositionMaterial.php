<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPositionMaterialCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Материал Техоперации
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-tehoperaciq-material-tehoperacii
 *
 * @implements AbstractNestedObject<ProcessingPositionMaterialCollection>
 */
class ProcessingPositionMaterial extends AbstractNestedObject
{
    public const PATH = [
        Segment::MATERIALS,
    ];
    public const TYPE = Type::PROCESSINGPOSITIONMATERIAL;
}
