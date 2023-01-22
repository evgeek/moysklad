<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Actions;

use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\GeneratorException;
use Generator;

trait GetGeneratorTrait
{
    /**
     * Create generator from request (only for iterable entities: with rows array and meta->limit/meta->offset fields)
     * <code>
     * $generator = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->getGenerator();
     * foreach ($generator as $product) {
     *      ...
     * }
     * </code>
     *
     * @throws FormatException
     * @throws ApiException
     * @throws GeneratorException
     */
    public function getGenerator(): Generator
    {
        return $this->apiGetGenerator();
    }
}
