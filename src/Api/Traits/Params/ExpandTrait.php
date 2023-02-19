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
     *  ->expand('demand')
     *  ->expand('agent,organization')
     *  ->expand(['group', 'images'])
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand
     */
    public function expand(array|string $fields): static
    {
        $this->initExpand();

        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->setExpand($field);
            }
        } else {
            $this->setExpand($fields);
        }

        return $this;
    }

    private function initExpand(): void
    {
        if (!array_key_exists(QueryParams::EXPAND->value, $this->params)) {
            $this->params[QueryParams::EXPAND->value] = '';
        }
    }

    private function setExpand(string $field): void
    {
        $this->params[QueryParams::EXPAND->value] .= $this->params[QueryParams::EXPAND->value] === '' ?
            $field :
            QueryParams::EXPAND->separator() . $field;
    }
}
