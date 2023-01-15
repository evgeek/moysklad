<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;

trait CreateTrait
{
    /**
     * Create entity (GET http request)
     * <code>
     * $product = $ms->query()
     *      ->entity()
     *      ->product()
     *      ->create(['name' => 'orange']);
     * </code>
     *
     * @throws FormatException
     * @throws ApiException
     */
    public function create(mixed $body)
    {
        return $this->apiSend(HttpMethod::POST, $body);
    }
}
