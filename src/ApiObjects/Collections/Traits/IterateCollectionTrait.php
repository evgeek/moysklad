<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\Exceptions\RequestException;

trait IterateCollectionTrait
{
    public function each(callable $closure): void
    {
        foreach ($this->rows ?? [] as $row) {
            $closure($row);
        }
    }

    /**
     * @throws RequestException
     */
    public function eachGenerator(callable $closure): void
    {
        $this->get();

        do {
            $this->each($closure);
        } while ($this->getNext());
    }
}
