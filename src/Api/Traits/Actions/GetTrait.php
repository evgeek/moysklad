<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;

trait GetTrait
{
    /**
     * Получить одиночную сущность или коллекцию сущностей.
     *
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->get();
     * </code>
     *
     * @throws RequestException
     */
    public function get()
    {
        return $this->apiSend(HttpMethod::GET);
    }
}
