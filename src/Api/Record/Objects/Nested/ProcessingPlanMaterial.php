<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanMaterialCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Материал Техкарты
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-materialy-tehkarty
 *
 * @implements AbstractNestedObject<ProcessingPlanMaterialCollection>
 */
class ProcessingPlanMaterial extends AbstractNestedObject
{
    public const PATH = [
        Segment::MATERIALS,
    ];
    public const TYPE = Type::PROCESSINGPLANMATERIAL;
}
