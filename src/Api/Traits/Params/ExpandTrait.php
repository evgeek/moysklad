<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\QueryParam;
use InvalidArgumentException;

trait ExpandTrait
{
    /**
     * Expand nested entity. Works only with limit <= 100 (API restriction)
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->limit(100)
     *  ->expand('owner')
     *  ->expand('minPrice.currency')
     *  ->expand(['group', 'images']);
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand
     */
    public function expand(array|string $fields): static
    {
        $this->initQueryParam(QueryParam::EXPAND);

        if (is_array($fields)) {
            return $this->handleArrayOfExpands($fields);
        }

        $this->params[QueryParam::EXPAND->value] .= $this->params[QueryParam::EXPAND->value] === '' ?
            $fields :
            QueryParam::EXPAND->separator() . $fields;

        return $this;
    }

    private function handleArrayOfExpands(array $expands): static
    {
        foreach ($expands as $expand) {
            if (!is_string($expand)) {
                throw new InvalidArgumentException('Each expand must be a string');
            }
            $this->expand($expand);
        }

        return $this;
    }
}
