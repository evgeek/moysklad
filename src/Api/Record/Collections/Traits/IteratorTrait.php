<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Traits;

trait IteratorTrait
{
    private int $iteratorKey = 0;

    public function current(): mixed
    {
        return $this->getRows()[$this->iteratorKey];
    }

    public function next(): void
    {
        ++$this->iteratorKey;
    }

    public function key(): int
    {
        return $this->iteratorKey;
    }

    public function valid(): bool
    {
        return array_key_exists($this->iteratorKey, $this->getRows());
    }

    public function rewind(): void
    {
        $this->iteratorKey = 0;
    }

    private function getRows(): array
    {
        return ($this->meta->size > 0 && $this->rows) ? $this->rows : [];
    }
}
