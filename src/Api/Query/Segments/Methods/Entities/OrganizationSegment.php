<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassCreateUpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\AttributesTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdOrganizationTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class OrganizationSegment extends AbstractEntitySegment
{
    use AttributesTrait;
    use ByIdOrganizationTrait;
    use CreateTrait;
    use MassCreateUpdateTrait;
    use MassDeleteTrait;
    use MetadataTrait;

    public const SEGMENT = Segment::ORGANIZATION;
}
