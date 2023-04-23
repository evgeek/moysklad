<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;

trait MassCreateUpdateTrait
{
    /**
     * Массовое создание и обновление сущностей
     *
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->massCreateUpdate($content);
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-sozdanie-i-obnowlenie-neskol-kih-ob-ektow
     *
     * @throws RequestException
     */
    public function massCreateUpdate(mixed $body)
    {
        return $this->apiSend(HttpMethod::POST, $body);
    }
}
