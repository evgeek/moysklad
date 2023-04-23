<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Segments\Methods\AbstractMethodSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Params\FilterTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Traits\Params\SearchTrait;
use Evgeek\Moysklad\Api\Traits\Segments\SettingsTrait;
use Evgeek\Moysklad\Dictionaries\Entity;

class AssortmentSegment extends AbstractMethodSegmentNamed
{
    use ExpandTrait;
    use FilterTrait;
    use GetGeneratorTrait;
    use GetTrait;
    use LimitOffsetTrait;
    use MassDeleteTrait;
    use OrderTrait;
    use SearchTrait;
    use SettingsTrait;

    public const SEGMENT = Entity::ASSORTMENT;
}
