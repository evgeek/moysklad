<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

trait SearchTrait
{
    /**
     * Context search
     *
     * @link https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-kontextnyj-poisk
     * <code>
     * $product = $ms->entity()
     *      ->product()
     *      ->search('orange')
     *      ->get();
     * </code>
     */
    public function search(string $text): static
    {
        $this->params['search'] = $text;
        return $this;
    }
}
