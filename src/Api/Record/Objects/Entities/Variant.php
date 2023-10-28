<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Barcode;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Pack;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Price;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\PriceWithType;
use Evgeek\Moysklad\Api\Record\Collections\Entities\VariantCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Модификация
 *
 * @property string             $accountId          ID учетной записи
 * @property bool               $archived           Добавлен ли Товар в архив
 * @property ?Barcode[]         $barcodes           Штрихкоды Комплекта
 * @property ?Price             $buyPrice           Закупочная цена
 * @property UnknownObject[]    $characteristics    Характеристики Модификации
 * @property ?string            $code               Код Модификации
 * @property ?string            $description        Описание Модификации
 * @property bool               $discountProhibited Признак запрета скидок
 * @property string             $externalCode       Внешний код Модификации
 * @property string             $id                 ID Модификации
 * @property ?UnknownCollection $images             Массив метаданных Изображений (Максимальное количество изображений - 10)
 * @property ?MetaObject        $meta               Метаданные Модификации
 * @property ?Price             $minPrice           Минимальная цена
 * @property string             $name               Наименование Модификации
 * @property ?Pack[]            $packs              Упаковки Модификации
 * @property Product            $product            Метаданные товара, к которому привязана Модификация
 * @property ?PriceWithType[]   $salePrices         Цены продажи
 * @property ?string[]          $things             Серийные номера
 * @property string             $updated            Момент последнего обновления сущности
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-modifikaciq
 *
 * @implements AbstractConcreteObject<VariantCollection>
 */
class Variant extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::VARIANT,
    ];
    public const TYPE = Type::VARIANT;
}
