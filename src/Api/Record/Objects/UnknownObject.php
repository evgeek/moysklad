<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects;

use Evgeek\Moysklad\Api\Record\AbstractUnknownRecord;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\Traits\CrudObjectTrait;
use Evgeek\Moysklad\Api\Record\Objects\Traits\FillMetaObjectTrait;
use Evgeek\Moysklad\Api\Record\Objects\Traits\ParamsObjectTrait;
use Evgeek\Moysklad\Api\Record\Objects\Traits\SetIdInMetaHrefTrait;
use Evgeek\Moysklad\MoySklad;

/**
 * Неизвестная сущность. Используется для работы с ещё не реализованными в библиотеке сущностями.
 *
 * @property string      $id
 * @property ?MetaObject $meta
 */
class UnknownObject extends AbstractUnknownRecord
{
    use CrudObjectTrait;
    use FillMetaObjectTrait;
    use ParamsObjectTrait;
    use SetIdInMetaHrefTrait;

    /**
     * Создаёт новый объект неизвестной сущности, опираясь на набор сегментов url $path и тип сущности $type.
     * Свойства объекта устанавливаются  из $content.
     *
     * <code>
     * $product = UnknownObject::make($ms, ['entity', 'product'], 'product', ['name' => 'orange']);
     * </code>
     */
    public static function make(MoySklad $ms, array $path, string $type, mixed $content = []): self
    {
        return new self($ms, $path, $type, $content);
    }

    /**
     * Создаёт новый объект неизвестной коллекции, опираясь на набор сегментов url $path и тип сущности $type.
     *
     * <code>
     * $productCollection = UnknownObject::collection($ms, ['entity', 'product'], 'product');
     * </code>
     */
    public static function collection(MoySklad $ms, array $path, string $type): UnknownCollection
    {
        return new UnknownCollection($ms, $path, $type);
    }
}
