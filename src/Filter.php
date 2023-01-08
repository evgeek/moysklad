<?php

declare(strict_types=1);

namespace Evgeek\Moysklad;

use Evgeek\Moysklad\Enums\FilterSigns;

final class Filter
{
    private const FILTER_DELIMITER = ';';
    private const FILTER_ESCAPED_DELIMITER = '\;';

    private string $filters = '';

    public function getFiltersString(): string
    {
        return $this->filters;
    }

    /** Equal (=) */
    public function eq(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::EQ);

        return $this;
    }

    /** Not equal (!=) */
    public function neq(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::NEQ);

        return $this;
    }

    /** Greater than (>) */
    public function gt(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::GT);

        return $this;
    }

    /** Lower than (<) */
    public function lt(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::LT);

        return $this;
    }

    /** Greater than or equal (>=) */
    public function gte(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::GTE);

        return $this;
    }

    /** Lower than or equal (<=) */
    public function lte(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::LTE);

        return $this;
    }

    /** Like (~) */
    public function like(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::LIKE);

        return $this;
    }

    /** Like by prefix (~=) */
    public function prefix(string $key, string $value): static
    {
        $this->addFilter($key, $value, FilterSigns::PREFIX);

        return $this;
    }

    /** Like by postfix (~=) */
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
        return str_replace(self::FILTER_DELIMITER, self::FILTER_ESCAPED_DELIMITER, $value);
    }
}
