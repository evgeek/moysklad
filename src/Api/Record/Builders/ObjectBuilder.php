<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Customerorder;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Document;
use Evgeek\Moysklad\Dictionaries\Entity;

class ObjectBuilder extends AbstractBuilder
{
    /**
     * Создаёт сущность Товар.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     *
     * @return Product
     */
    public function product(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Entity::PRODUCT, $content);
    }

    /**
     * Создаёт сущность Сотрудник.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
     *
     * @return Employee
     */
    public function employee(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Entity::EMPLOYEE, $content);
    }

    /**
     * Создаёт сущность Заказ покупателя.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     *
     * @return Customerorder
     */
    public function customerorder(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Document::CUSTOMERORDER, $content);
    }

    /**
     * Создаёт неизвестную сущность. Используется для не реализованных в библиотеке сущностей.
     *
     * <code>
     * $product = $ms->object()
     *  ->single()
     *  ->unknown(['entity', 'product', '1958e4df-f7ca-11ed-0a80-030500578f19'], 'product');
     * </code>
     */
    public function unknown(array $path, string $type, mixed $content = []): UnknownObject
    {
        return new UnknownObject($this->ms, $path, $type, $content);
    }
}
