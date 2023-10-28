<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Alcoholic;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Barcode;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Pack;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Price;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\PriceWithType;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Товар
 *
 * @property string             $accountId           ID учетной записи
 * @property ?Alcoholic         $alcoholic           Объект, содержащий поля алкогольной продукции
 * @property bool               $archived            Добавлен ли Товар в архив
 * @property ?string            $article             Артикул
 * @property ?UnknownObject[]   $attributes          Коллекция доп. полей
 * @property ?Barcode[]         $barcodes            Штрихкоды Комплекта
 * @property ?Price             $buyPrice            Закупочная цена
 * @property ?string            $code                Код Товара
 * @property ?UnknownObject     $country             Метаданные Страны
 * @property ?string            $description         Описание Товара
 * @property bool               $discountProhibited  Признак запрета скидок
 * @property ?int               $effectiveVat        Реальный НДС %
 * @property ?bool              $effectiveVatEnabled Дополнительный признак для определения разграничения реального НДС = 0 или "без НДС"
 * @property string             $externalCode        Внешний код Товара
 * @property ?UnknownCollection $files               Метаданные массива Файлов (Максимальное количество файлов - 100)
 * @property UnknownObject      $group               Метаданные отдела сотрудника
 * @property string             $id                  ID Товара
 * @property ?UnknownCollection $images              Массив метаданных Изображений (Максимальное количество изображений - 10)
 * @property ?bool              $isSerialTrackable   Учет по серийным номерам. Данная отметка не сочетается с признаками weighed, alcoholic, ppeType, trackingType, onTap.
 * @property ?MetaObject        $meta                Метаданные Товара
 * @property ?Price             $minPrice            Минимальная цена
 * @property ?int               $minimumBalance      Неснижаемый остаток
 * @property string             $name                Наименование Товара
 * @property ?Employee          $owner               Метаданные владельца (Сотрудника)
 * @property ?Pack[]            $packs               Упаковки Товара
 * @property ?bool              $partialDisposal     Управление состоянием частичного выбытия маркированного товара. «true» - возможность включена
 * @property string             $pathName            Наименование группы, в которую входит Товар
 * @property ?string            $paymentItemType     Признак предмета расчета
 * @property ?string            $ppeType             Код вида номенклатурной классификации медицинских средств индивидуальной защиты (EAN-13)
 * @property ?UnknownObject     $productFolder       Метаданные группы Товара
 * @property ?PriceWithType[]   $salePrices          Цены продажи
 * @property bool               $shared              Общий доступ
 * @property ?UnknownObject     $supplier            Метаданные контрагента-поставщика
 * @property ?string            $syncId              ID синхронизации
 * @property ?string            $taxSystem           Код системы налогообложения
 * @property ?string[]          $things              Серийные номера
 * @property ?string            $tnved               Код ТН ВЭД
 * @property ?string            $trackingType        Тип маркируемой продукции
 * @property ?UnknownObject     $uom                 Единицы измерения
 * @property string             $updated             Момент последнего обновления сущности
 * @property bool               $useParentVat        Используется ли ставка НДС родительской группы
 * @property int                $variantsCount       Количество модификаций у данного товара
 * @property ?int               $vat                 НДС %
 * @property ?bool              $vatEnabled          Включен ли НДС для товара. С помощью этого флага для товара можно выставлять НДС = 0 или НДС = "без НДС"
 * @property ?int               $volume              Объем
 * @property ?int               $weight              Вес
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
 *
 * @implements AbstractConcreteObject<ProductCollection>
 */
class Product extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PRODUCT,
    ];
    public const TYPE = Type::PRODUCT;
}
