<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Services\CollectionHelper;

trait MassCreateUpdateTrait
{
    /**
     * Массовое изменение и/или удаление сущностей. Сущности с id будут обновлены, без - созданы.
     *
     * <code>
     * $product1 = ['name' => 'Корнишоны'];
     * $product2 = Product::make($ms, [
     *  'id' => 'efcddaff-f308-11ed-0a80-09ee0084c2c6',
     *  'name' => 'Кабачки',
     * ]);
     * $product3 = [
     *  'meta' => Meta::product('1a4d67b8-f309-11ed-0a80-086800825780'),
     *  'name' => 'Патиссоны',
     * ];
     *
     * $products = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->massCreateUpdate([$product1, $product2, $product3]);
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-sozdanie-i-obnowlenie-neskol-kih-ob-ektow
     *
     * @throws RequestException
     */
    public function massCreateUpdate(mixed $objects)
    {
        $objects = CollectionHelper::extractRows($objects);

        return $this->apiSend(HttpMethod::POST, $objects);
    }
}
