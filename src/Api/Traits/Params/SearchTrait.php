<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Services\QueryParams;

trait SearchTrait
{
    /**
     * Context search
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->search('orange')
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-kontextnyj-poisk
     */
    public function search(string $text): static
    {
        $this->params = QueryParams::setSearch($this->params, $text);

        return $this;
    }
}
