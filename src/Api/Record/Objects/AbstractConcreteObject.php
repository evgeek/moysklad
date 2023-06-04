<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects;

use Evgeek\Moysklad\Api\Record\AbstractConcreteRecord;
use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Traits\CrudObjectTrait;
use Evgeek\Moysklad\Api\Record\Objects\Traits\FillMetaObjectTrait;
use Evgeek\Moysklad\Api\Record\Objects\Traits\ParamsObjectTrait;
use Evgeek\Moysklad\Api\Record\Objects\Traits\SetIdInMetaHrefTrait;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\RecordMappingHelper;

/**
 * @template T of AbstractConcreteCollection
 */
abstract class AbstractConcreteObject extends AbstractConcreteRecord
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
        return RecordMappingHelper::resolveCollection($ms, static::TYPE);
    }
}
