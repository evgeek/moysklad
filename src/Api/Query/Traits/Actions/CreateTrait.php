<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;

trait CreateTrait
{
    /**
     * Создание сущности в Моём Складе.
     *
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->create(['name' => 'orange']);
     * </code>
     *
     * @throws RequestException
     */
    public function create(mixed $body)
    {
        return $this->apiSend(HttpMethod::POST, $body);
    }
}
