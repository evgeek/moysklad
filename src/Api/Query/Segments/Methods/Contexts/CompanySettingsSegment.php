<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts;

use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Query\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataTrait;
use Evgeek\Moysklad\Dictionaries\Segment;

class CompanySettingsSegment extends AbstractMethodNamedSegment
{
    use GetGeneratorTrait;
    use MetadataTrait;
    use UpdateTrait;

    public const SEGMENT = Segment::COMPANYSETTINGS;

    /**
     * Типы цен.
     *
     * <code>
     * $priceTypes = $ms->query()
     *  ->context()
     *  ->pricetype()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tipy-cen
     */
    public function pricetype(): PriceTypeSegment
    {
        return $this->resolveNamedBuilder(PriceTypeSegment::class);
    }
}
