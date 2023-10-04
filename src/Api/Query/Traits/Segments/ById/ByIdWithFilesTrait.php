<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdWithFilesSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdWithPositionsSegment;

trait ByIdWithFilesTrait
{
    /**
     * Работа с одиночной сущностью по id.
     *
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->get();
     * </code>
     */
    public function byId(string $guid): ByIdWithFilesSegment
    {
        return $this->resolveCommonBuilder(ByIdWithFilesSegment::class, $guid);
    }
}
