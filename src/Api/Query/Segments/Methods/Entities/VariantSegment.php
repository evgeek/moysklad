<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassCreateUpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdVariantTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataForVariantTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class VariantSegment extends AbstractEntitySegment
{
    use ByIdVariantTrait;
    use CreateTrait;
    use MassCreateUpdateTrait;
    use MassDeleteTrait;
    use MetadataForVariantTrait;

    public const SEGMENT = Segment::VARIANT;
}
