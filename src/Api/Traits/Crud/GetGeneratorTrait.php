<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Crud;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\ApiException;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\GeneratorException;
use Generator;

trait GetGeneratorTrait
{
    /**
     * Create generator from request (only for iterable entities: with rows array and meta->limit/meta->offset fields)
     * <code>
     * $generator = $ms->entity()
     *      ->product()
     *      ->getGenerator();
     * foreach ($generator as $product) {
     *      ...
     * }
     * </code>
     * @throws FormatException
     * @throws ApiException
     * @throws GeneratorException
     */
    public function getGenerator(): Generator
    {
        $payloadList = $this->addPayloadToList(HttpMethod::GET);
        return $this->apiGetGenerator($payloadList);
    }
}
