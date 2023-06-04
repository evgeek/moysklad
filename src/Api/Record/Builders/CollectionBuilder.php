<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerorderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\AssortmentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Dictionaries\Document;
use Evgeek\Moysklad\Dictionaries\Entity;

class CollectionBuilder extends AbstractBuilder
{
    /**
     * Создаёт коллекцию Товаров.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     *
     * @return ProductCollection
     */
    public function product(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Entity::PRODUCT);
    }

    /**
     * Создаёт коллекцию Сотрудников.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
     *
     * @return EmployeeCollection
     */
    public function employee(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Entity::EMPLOYEE);
    }

    /**
     * Создаёт коллекцию Ассортиментов (Товары, Услуги, Комплекты, Серии и Модификаци).
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-assortiment
     *
     * @return AssortmentCollection
     */
    public function assortment(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Entity::ASSORTMENT);
    }

    /**
     * Создаёт коллекцию Заков покупателя.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     *
     * @return CustomerorderCollection
     */
    public function customerorder(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Document::CUSTOMERORDER);
    }

    /**
     * Создаёт неизвестную коллекцию. Используется для не реализованных в библиотеке коллекций.
     *
     * <code>
     * $productCollection = $ms->object()->collection()->unknown(['entity', 'product'], 'product');
     * </code>
     */
    public function unknown(array $path, string $type): UnknownCollection
    {
        return new UnknownCollection($this->ms, $path, $type);
    }
}
