<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Exceptions\RequestException;
use Generator;

trait GetGeneratorTrait
{
    /**
     * Создать генератор из запроса итерируемой сущности.
     * Генератор можно перебирать в цикле, при этом подгружать новые страницы он будет самостоятельно.
     *
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
     * @throws RequestException
     */
    public function getGenerator(): Generator
    {
        return $this->apiGetGenerator();
    }
}
