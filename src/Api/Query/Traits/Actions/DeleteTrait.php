<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;

trait DeleteTrait
{
    /**
     * Удаление сущности.
     *
     * <code>
     * $ms->query()
     *  ->entity()
     *  ->product()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->delete();
     * </code>
     *
     * @throws RequestException
     */
    public function delete()
    {
        return $this->apiSend(HttpMethod::DELETE);
    }
}
