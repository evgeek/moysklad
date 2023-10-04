<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Documents;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\NamedFilterTrait;

class AbstractDocumentSegment extends AbstractMethodNamedSegment
{
    use NamedFilterTrait;
    use GetGeneratorTrait;
}
