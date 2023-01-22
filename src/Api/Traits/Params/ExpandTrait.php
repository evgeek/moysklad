<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\QueryParams;

trait ExpandTrait
{
    /**
     * Expand nested entity
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->expand('group', 'images')
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand
     */
    public function expand(string ...$fields): static
    {
        if (!array_key_exists(0, $fields)) {
            return $this;
        }

        if (!array_key_exists(QueryParams::EXPAND->value, $this->params)) {
            $this->params[QueryParams::EXPAND->value] = '';
        }
        foreach ($fields as $field) {
            $this->params[QueryParams::EXPAND->value] .= $this->params[QueryParams::EXPAND->value] === '' ?
                $field :
                QueryParams::EXPAND->separator() . $field;
        }

        return $this;
    }
}
