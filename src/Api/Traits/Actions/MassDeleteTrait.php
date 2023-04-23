<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Segments\Special\MassDeleteSegment;
use Evgeek\Moysklad\Exceptions\RequestException;

trait MassDeleteTrait
{
    /**
     * Массовое удаление сущностей
     *
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->massDelete([
     *      ['meta' => Meta::product('051c81fa-e1ba-11ed-0a80-0f4100572c02')],
     *      ['meta' => Meta::product('25cf41f2-b068-11ed-0a80-0e9700500d7e')],
     *  ]);
     * </code>
     *
     * @throws RequestException
     */
    public function massDelete(mixed $body)
    {
        return (new MassDeleteSegment($this->api, $this->path, $this->params))->massDelete($body);
    }
}
