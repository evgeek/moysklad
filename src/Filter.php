<?php

declare(strict_types=1);

namespace Evgeek\Moysklad;

use Evgeek\Moysklad\Enums\FilterSigns;

class Filter
{
    private const FILTER_DELIMITER = ';';
    private const FILTER_ESCAPED_DELIMITER = '\;';

    private string $filters = '';

    public function getFiltersString(): string
    {
        return $this->filters;
    }

    public function eq(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::EQ);
        return $this;
    }

    public function neq(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::NEQ);
        return $this;
    }

    public function gt(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::GT);
        return $this;
    }

    public function lt(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::LT);
        return $this;
    }

    public function gte(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::GTE);
        return $this;
    }

    public function lte(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::LTE);
        return $this;
    }

    public function like(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::LIKE);
        return $this;
    }

    public function prefix(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::PREFIX);
        return $this;
    }

    public function postfix(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::POSTFIX);
        return $this;
    }

    private function addFilter(string $key, string $value, FilterSigns $sign): void
    {
        $filter = $this->prepareFiltered($key) . $sign->value . $this->prepareFiltered($value);

        $this->filters .= $this->filters === '' ? $filter : ";$filter";
    }

    private function prepareFiltered(string $value): string
    {
        return str_replace(static::FILTER_DELIMITER, static::FILTER_ESCAPED_DELIMITER, $value);
    }
}