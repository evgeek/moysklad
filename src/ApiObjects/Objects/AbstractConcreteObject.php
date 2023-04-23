<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\CrudObjectTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\FillMetaObjectTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\ParamsObjectTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetIdInMetaHrefTrait;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\ApiObjectMappingHelper;

/**
 * @template T of AbstractConcreteCollection
 */
abstract class AbstractConcreteObject extends AbstractConcreteApiObject
{
    use CrudObjectTrait;
    use FillMetaObjectTrait;
    use ParamsObjectTrait;
    use SetIdInMetaHrefTrait;

    public static function make(MoySklad $ms, array $content): static
    {
        return new static($ms, $content);
    }

    /**
     * @return T
     */
    public static function collection(MoySklad $ms): AbstractConcreteCollection
    {
        return ApiObjectMappingHelper::resolveCollection($ms, static::TYPE);
    }
}
