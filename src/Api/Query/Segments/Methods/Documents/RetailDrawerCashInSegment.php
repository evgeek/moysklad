<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Documents;

use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassCreateUpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class RetailDrawerCashInSegment extends AbstractDocumentSegment
{
    use ByIdCommonTrait;
    use CreateTrait;
    use MassCreateUpdateTrait;
    use MassDeleteTrait;
    use MetadataTrait;

    public const SEGMENT = Segment::RETAILDRAWERCASHIN;
}
