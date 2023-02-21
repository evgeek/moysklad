<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\QueryParam;

trait ExpandTrait
{
    /**
     * Expand nested entity
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->expand('demand')
     *  ->expand(['group', 'images'])
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand
     */
    public function expand(array|string $fields): static
    {
        $this->initQueryParam(QueryParam::EXPAND);

        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->setExpand($field);
            }
        } else {
            $this->setExpand($fields);
        }

        return $this;
    }

    private function setExpand(string $field): void
    {
        $this->params[QueryParam::EXPAND->value] .= $this->params[QueryParam::EXPAND->value] === '' ?
            $field :
            QueryParam::EXPAND->separator() . $field;
    }
}
