<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\DefaultSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdCommonTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class PriceTypeSegment extends AbstractMethodNamedSegment
{
    use ByIdCommonTrait;
    use CreateTrait;
    use GetGeneratorTrait;
    use UpdateTrait;

    public const SEGMENT = Segment::PRICETYPE;

    /**
     * Тип цены по умолчанию.
     *
     * <code>
     * $defaultPriceType = $ms->query()
     *  ->context()
     *  ->companysettings()
     *  ->pricetype()
     *  ->default()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tipy-cen-poluchit-tip-ceny-po-umolchaniu
     */
    public function default(): DefaultSegment
    {
        return $this->resolveNamedBuilder(DefaultSegment::class);
    }
}
