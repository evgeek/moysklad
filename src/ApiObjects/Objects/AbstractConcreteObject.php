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

    /**
     * Создаёт новый объект сущности данного класса, наполяя его параметрами из $content.
     *
     * <code>
     * $product = Product::make($ms, ['name' => 'orange']);
     * </code>
     */
    public static function make(MoySklad $ms, mixed $content = []): static
    {
        return new static($ms, $content);
    }

    /**
     * Создаёт новый объект коллекции данного класса.
     *
     * <code>
     * $productCollection = Product::collection($ms);
     * </code>
     *
     * @return T
     */
    public static function collection(MoySklad $ms): AbstractConcreteCollection
    {
        return ApiObjectMappingHelper::resolveCollection($ms, static::TYPE);
    }
}
