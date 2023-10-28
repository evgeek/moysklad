<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects;

use Evgeek\Moysklad\Api\Record\AbstractNestedRecord;
use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Traits\CrudObjectTrait;
use Evgeek\Moysklad\Api\Record\Objects\Traits\FillMetaObjectTrait;
use Evgeek\Moysklad\Api\Record\Objects\Traits\ParamsObjectTrait;
use Evgeek\Moysklad\Api\Record\Objects\Traits\SetIdInMetaHrefTrait;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\RecordMappingHelper;

/**
 * @template T of AbstractNestedCollection
 */
abstract class AbstractNestedObject extends AbstractNestedRecord implements ObjectInterface
{
    use CrudObjectTrait;
    use FillMetaObjectTrait;
    use ParamsObjectTrait;
    use SetIdInMetaHrefTrait;

    /**
     * Создаёт новый объект вложенной сущности данного класса, наполяя его параметрами из $content.
     * Требуется передать родительскую сущность $parent в формате типа объекта/имени класса если у родителя нет id,
     *  или объекта или массива сегментов, если у родительской сущности есть id.
     *
     * <code>
     * $parent = Product::make($ms); //Или ['entity', 'product'], 'product', Product::class
     * $productFilter = NamedFilter::make($ms, $parent, [
     *  'id' => 'd9b8badf-2332-11ee-0a80-07e1001e2562'
     * ])->get()
     * </code>
     */
    public static function make(MoySklad $ms, ObjectInterface|array|string $parent, mixed $content = []): static
    {
        return new static($ms, $parent, $content);
    }

    /**
     * Создаёт новый объект вложенной коллекции данного класса.
     * Требуется передать родительскую сущность $parent в формате типа объекта/имени класса если у родителя нет id,
     *  или объекта или массива сегментов, если у родительской сущности есть id.
     *
     * <code>
     * $parent = ['entity', 'product']; //Или Product::make($ms), 'product', Product::class
     * $productFilters = NamedFilter::collection($ms, $parent)->get();
     * </code>
     *
     * @return T
     */
    public static function collection(MoySklad $ms, ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return RecordMappingHelper::resolveNestedCollection($ms, $parent, static::TYPE);
    }
}
